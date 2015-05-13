<?php
namespace DubInfo_gestion_immobilier\excel;
/**
 * Description of SheetExcel
 *
 * @author Alexandre
 */
abstract class SheetExcel {
    const FIRST_LINE = 6;
    const SPACE_WITH_TITLE = 2;
    const HEIGHT_TITLE_QUESTION = 30;
   
//<editor-fold defaultstate="collapsed" desc="list style">
    protected $STYLE_DEFAULT = array(
                        'font' => array(
                            'size' => 10,
                            'name' => 'Verdana'
                        )
                    );
    protected $STYLE_TITLE= array(
                        'font'  => array(
                            'bold'  => true,
                            'size'  => 9,
                            'underline' => 'single'
                        )
                    );
    
    protected $STYLE_INFO = array(
                        'font'  => array(
                            'bold'  => true
                        ),
                        'alignment' =>array(
                            'vertical' => \PHPExcel_Style_Alignment::VERTICAL_CENTER
                        )
                    );
    
    protected $STYLE_QUESTION_TITLE = array(
                        'alignment' =>array(
                            'vertical' => \PHPExcel_Style_Alignment::VERTICAL_CENTER,
                        )
                    );
    
    protected $STYLE_PROPOSITION = array(
                            'borders'  => array(
                                'allborders' => array(
                                    'style' => \PHPExcel_style_Border::BORDER_THIN
                                )
                            ),
                            'alignment' => array(
                                'horizontal' => \PHPExcel_Style_Alignment::HORIZONTAL_CENTER
                            )
                        );
    
    protected $STYLE_QUESTIONNEMENT = array(
                            'borders' => array(
                                'allborders' => array(
                                    'style' => \PHPExcel_Style_Border::BORDER_THIN
                                )
                            ),
                            'alignment' => array(
                                'vertical' => \PHPExcel_Style_Alignment::VERTICAL_CENTER
                            )
                        );
    protected $STYLE_RESULT = array(
                            'borders' => array(
                                'allborders' => array(
                                    'style' => \PHPExcel_Style_Border::BORDER_THIN
                                )
                            ),
                            'alignment' => array(
                                'horizontal' => \PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                                'vertical' => \PHPExcel_Style_Alignment::VERTICAL_CENTER
                            ),
                            'font' => array(
                                'bold' => true,
                                'size' => 14
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
    public function __construct($data=NULL) {
        $this->setData($data);
    }
  
    /**
     * Fonction qui crée le worksheet en fonction du stage
     * @return Worksheet
     */
    public function createSheet($excel_doc) {
        $this->setSheet(new \PHPExcel_Worksheet($excel_doc, $this->getSheetName()));
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
    protected abstract function writeTitle();
    
    /**
     * Méthode qui écrit les entêtes des tableaux
     */
    protected abstract function writeHeaderTable();
    
    /**
     * Méthode qui écrit les données du tableau dans le tableau
     */
    protected abstract function writeDataTable();
    
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
     */
    protected function setStyleHeaderTable() {
        //à coder
    }
    
    /**
     * Méthode pour ajouter les styles à une ligne du tableau
     */
    protected function setStyleLineTable() {
        //à coder
    }
    
    /**
     * Méthode pour ajouter les styles au titre
     */
    protected function setStyleTitle() {
        $this->getSheet()->getStyle('A'. $this->getCurrentLine())
                ->applyFromArray($this->STYLE_TITLE);
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
     * 
     * @return string Nom de la feuille excel
     */
    public abstract function getSheetName();
//</editor-fold>
}
