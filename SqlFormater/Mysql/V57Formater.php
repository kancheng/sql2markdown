<?php
/**
 *
 * User: wowo
 * Date: 2019/4/17 下午5:03
 */
namespace s2d\formater\mysql;

use s2d\formater\BaseFormater;
use s2d\structure\TableStructure;

class V57Formater extends BaseFormater
{

    private $file_path;

    private $sections;

    /**
     * @var $tables TableStructure[]
     */
    private $tables;

    public function __construct($file_path)
    {
        if (!file_exists($file_path)) {
            die('Data file does not exist.');
        }
        $this->file_path = $file_path;
    }

    public function splitSections()
    {
        $file = fopen($this->file_path, 'r');
        $current_section = null;
        $current_table_name = null;
        $section_open = false;
        while (!feof($file)) {
            $line = fgets($file);
            if (!$section_open) {
                if (strpos(strtolower($line), 'create') === 0) {
                    $section_open = true;
                    $current_section = [];
                    $current_table_name = trim(array_slice(explode(' ', $line), - 2, 1)[0], '`');
                }
            } elseif (strpos(strtolower($line), ';') > 0) {
                $current_section[] = $line;
                $this->sections[$current_table_name] = $current_section;
                $section_open = false;
                $current_section = null;
                $current_table_name = null;
            } else {
                $current_section[] = $line;
            }
        }
    }

    public function geneTables()
    {
        foreach ($this->sections as $table_name => $columns) {
            $table = new TableStructure($table_name);
            foreach ($columns as $column) {
                $column = trim($column);
                if (strpos(strtolower($column), ';') > 0) {
                    $table->setTableInfo($column);
                } elseif (strpos(strtolower($column), 'primary key') !== false) {
                    $table->setPrimaryKey($column);
                } elseif(strtolower(substr($column, 0, 3)) === 'key' || strtolower(substr($column, 0, 6)) === 'unique'){
                    
                } else {
                    $table->setColumn($column);
                }
            }
            $this->tables[] = $table;
        }
    }

    public function formatOutput($output_file_path, $lang = 'en')
    {
        ob_start();
        $lang_table = '';
        $lang_table_head = '';
        if ($lang == 'en') {
            $lang_table = "|Name|Type|Length/Values|default|Comments|\n";
            $lang_table_head = "Table";
        }
        if ($lang == 'sc') {
            $lang_table = "|名字|类型|长度/值|默认值|备注|\n";
            $lang_table_head = "表";
        }
        if ($lang == 'tc') {
            $lang_table = "|名稱|型態|長度/值|預設值|備註|\n";
            $lang_table_head = "表";
        }
        if ($lang == 'de') {
            $lang_table = "|Name|Typ|Länge/Werte|Standard|Kommentare|\n";
            $lang_table_head = "Tabelle";
        }
        if ($lang == 'jp') {
            $lang_table = "|名前|データ型|長さ/値|デフォルト値|コメント|\n";
            $lang_table_head = "テーブル";
        }
        foreach ($this->tables as $table) {
            echo "### " . $table->getTableName() . " ". $lang_table_head . " (" . $table->getComment() . ")\n";

            echo $lang_table;
            echo "|---|---|---|---|---|\n";
            foreach ($table->getColumns() as $column) {
                echo "|" . $column->getName() . "|" . $column->getType() . "|" . $column->getLength() . "|" . $column->getDefaultValue() . "|" . $column->getComment() . "|\n";
            }
            echo "\n\n";
        }
        $file = fopen($output_file_path, "w");
        fwrite($file, ob_get_contents());
        ob_end_clean();
    }
}
