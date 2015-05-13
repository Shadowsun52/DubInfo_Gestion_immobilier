<?php
namespace DubInfo_gestion_immobilier\excel;
use DateTime;
/**
 * Description of SheetExcel
 *
 * @author Alexandre
 */
abstract class SheetExcel {
    const FIRST_LINE = 1;
    const SPACE_WITH_TITLE = 2;
    const HEIGHT_TITLE_QUESTION = 30;
    const FIRST_COL = 'A';
   
//<editor-fold defaultstate="collapsed" desc="list style">
    protected $STYLE_DEFAULT = array(
                        'font' => array(
                            'size' => 12,
                            'name' => 'Verdana'
                        ),
                        'alignment' => array (
                            'wrap' => true
                        )
                    );
    protected $STYLE_TITLE= array(
                        'font'  => array(
                            'bold'  => true,
                            'size'  => 15,
                            'underline' => 'single'
                        )
                    );
    
    protected $STYLE_HEADER_COLUMN = array(
                            'borders' => array(
                                'allborders' => array(
                                    'style' => \PHPExcel_Style_Border::BORDER_THIN
                                )
                            ),
                            'alignment' => array(
                                'horizontal' => \PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                                'vertical' => \PHPExcel_Style_Alignment::VERTICAL_CENTER
                            ),
                            'font' => array (
                                'bold' => true
                            )
                        );
    protected $STYLE_DATA = array(
                            'borders' => array(
                                'allborders' => array(
                                    'style' => \PHPExcel_Style_Border::BORDER_THIN
                                )
                            ),
                            'alignment' => array(
                                'vertical' => \PHPExcel_Style_Alignment::VERTICAL_CENTER
                            )
                        );
//</editor-fold>
    
    /**
     * @var array[mixed] Stage lié à la feuille Excel
     */
    private $_data;
    
    /**
     * @var int Ligne courante dans la Feuille Excel 
     */
    private $_current_line;
    
    /**
     * @var Worksheet Feuille Excel où l'on écrit 
     */
    private $_sheet;
    
    /**
     * 
     * @param array[mixed] $data data utilisées pour remplir la feuille Excel
     */
    public function __construct($data) {
        $this->setData($data);
    }
  
    /**
     * Fonction qui crée le worksheet en fonction du stage
     * @return Worksheet
     */
    public function createSheet($excel_doc) {
        $this->setSheet(new \PHPExcel_Worksheet($excel_doc, 'bestInvestment'));
        $excel_doc->addSheet($this->getSheet());
        $this->writeSheet();
        $this->protectWorksheet();
    }
    
//<editor-fold defaultstate="collapsed" desc="writer">

    protected function writeSheet() {
        $this->getSheet()->getDefaultStyle()->applyFromArray($this->STYLE_DEFAULT);
        $this->goFirstLine();
        $this->setColWidth();
        $this->writeTitle();
        $this->writeHeaderTable();
        $this->writeDataTable();
    }
    
    /**
     * Ecrit le nom du document dans le fichier excel
     */
    protected function writeTitle() {
        $today = new DateTime();
        $title = $this->getDocTitle() . " (générée le " 
                . $today->format('d/m/Y'). ")";
        $this->setStyleTitle();
        $this->getSheet()->setCellValue(
                'A'.$this->moveCurrentLine(self::SPACE_WITH_TITLE),$title);
    }
    
    /**
     * Méthode qui écrit les entêtes des tableaux
     */
    protected function writeHeaderTable() {
        $col = self::FIRST_COL;
        foreach ($this->getNameColumns() as $name_column) {
            $this->getSheet()->setCellValue(($col++). $this->getCurrentLine(),
                    $name_column);   
        }
        $this->setStyleHeaderTable(chr(ord($col) - 1));
    }
    
    /**
     * Méthode qui écrit les données du tableau dans le tableau
     */
    protected function writeDataTable() {
        foreach ($this->getData() as $item) {
            $col = self::FIRST_COL;
            foreach ($item as $key => $value) {
                $this->getSheet()->setCellValue(($col++). $this->getCurrentLine(),
                ((!strpos($key, 'num'))? ' ' : '') . $value);
            }
            $this->setStyleLineTable(chr(ord($col) - 1));
        }
    }
    
    /**
     * Méthode qui vérrouille la feuille excel
     */
    protected function protectWorksheet() {
        $this->getSheet()->getProtection()->setSheet(true);
        $this->getSheet()->getProtection()->setSort(true);
        $this->getSheet()->getProtection()->setInsertRows(true);
        $this->getSheet()->getProtection()->setFormatCells(true);
        $this->getSheet()->getProtection()->setPassword('root@psw');
    }
//</editor-fold>
    
//<editor-fold defaultstate="collapsed" desc="style">
    /**
     * Méthode pour définir la taille des colonnes
     */
    protected abstract function setColWidth();
    
    /**
     * Méthode pour ajouter les styles à l'entête du tableau
     * @param string $end_col La derniere colonne avec des données
     */
    protected function setStyleHeaderTable($end_col) {
        $this->getSheet()->getStyle(self::FIRST_COL. $this->getCurrentLine() 
                . ':' . $end_col . $this->moveCurrentLine())
                ->applyFromArray($this->STYLE_HEADER_COLUMN);
    }
    
    /**
     * Méthode pour ajouter les styles à une ligne du tableau
     * @param string $end_col La derniere colonne avec des données
     */
    protected function setStyleLineTable($end_col) {
        $this->getSheet()->getStyle(self::FIRST_COL. $this->getCurrentLine() 
                . ':' . $end_col 
                . $this->moveCurrentLine())->applyFromArray($this->STYLE_DATA);
    }
    
    /**
     * Méthode pour ajouter les styles au titre
     */
    protected function setStyleTitle() {
        $this->getSheet()->mergeCells('A' . $this->getCurrentLine() . ':G' 
                . $this->getCurrentLine());
        $this->getSheet()->getStyle('A'. $this->getCurrentLine())
                ->applyFromArray($this->STYLE_TITLE);
        $this->getSheet()->getRowDimension($this->getCurrentLine())
                     ->setRowHeight(self::HEIGHT_TITLE_QUESTION);
    }
//</editor-fold>
    
//<editor-fold defaultstate="collapsed" desc="getter&setter">    
    /**
     * 
     * @return array[mixed]
     */
    public function getData() {
        return $this->_data;
    }
    
    /**
     * 
     * @param array[mixed] $data
     */
    public function setData($data) {
        if($data == NULL)
        {
            $this->_data = [];
        }
        else
        {
            $this->_data = $data;    
        }
    }
    
    /**
     * 
     * @return int
     */
    public function getCurrentLine() {
        return $this->_current_line;
    }
    
    /**
     * 
     * @param int $current_line
     */
    public function setCurrentLine($current_line) {
        $this->_current_line = $current_line;
    }
    
    public function goFirstLine() {
        $this->setCurrentLine(self::FIRST_LINE);
    }
    
    /**
     * 
     * @param int $number_move nombre de ligne à avancer
     * @return int retourne la ligne avant le déplacement
     */
    protected function moveCurrentLine($number_move=1){
        $current_line = $this->getCurrentLine();
        $this->setCurrentLine($this->getCurrentLine() + $number_move);
        return $current_line;
    }
    
    /**
     * 
     * @return Worksheet
     */
    public function getSheet() {
        return $this->_sheet;
    }
    
    /**
     * 
     * @param Worksheet $sheet
     */
    public function setSheet($sheet) {
        $this->_sheet = $sheet;
    }
    
    /**
     * Fonction qui retourne le nom des colonnes de la table
     * @return array[string]
     */
    public abstract function getNameColumns();
    
    /**
     * Fonction qui retourne la partie personnalisé du titre du document
     * @return string 
     */
    public abstract function getDocTitle();
//</editor-fold>
}
