<?php
namespace DubInfo_gestion_immobilier\excel;

/**
 * Description of DocumentExcel
 *
 * @author Alexandre
 */
class DocumentExcel {
    /* 
     * chemin d'access pour le dossier ou est stocké les documents excels
     */
    const SAVE_PATH = "../document_excel/";

    /**
     * Tableau des type d'item gérer pour la création d'un fichier excel
     * @var array[string] 
     */
    static private $ITEM_ACCEPTED = ['locataire' , 'location', 'paiementLoyer', 
        'investisseur', 'rencontreInvestisseur', 'visiteMaisonInvestisseur', 
        'projet', 'maison', 'chambre'];


    /**
     * @var PHPExcel objet document excel 
     */
    private $_excel_doc;
    
    /**
     * @var SheetExcel Feuille excel lié au document 
     */
    private $_sheet_excel;
    
    /**
     * @var string Type des items à écrire dans le fichier excel 
     */
    private $_type_item;
    
    /**
     * 
     * @param int $type_item Type de l'item voulu
     * @throws Exception
     */
    public function __construct($type_item) {
        $this->setTypeItem($type_item);
        $this->setSheetExcel($this->createSheetExcel($data));
    }
    
//<editor-fold defaultstate="collapsed" desc="Generate Doc">
    /**
     * Generer le document excel
     */
    public function generateDocument() {
        $this->initExcelDoc();
        $this->addContain();
        $this->saveDocument();
    }
    
    /**
     * Méthode qui écrit la feuille excel
     */
    protected function addContain(){
        $this->getSheetExcel()->createSheet($this->getExcelDoc());
    }

    /**
     * Méthode qui initialise l'objet PHPExcel
     */
    public function initExcelDoc() {
        $this->setExcelDoc(new \PHPExcel());
    }
    
    /**
     * Méthode Qui créer l'object php d'une feuille excel correspondant au type
     * de l'item
     * @param type $data Données à lié à la sheetExcel
     * @return mixed
     */
    protected function createSheetExcel($data){
        $name_classe = "SheetExcel" . $this->getTypeItem();
        
        return new $name_classe($data);
    }
    
    /**
     * Attache une feuille excel au document excel
     * @param Worksheet $sheet La feuille excel à attacher
     */
    protected function attachSheetToDoc($sheet) {
        $this->getExcelDoc()->addSheet($sheet);
    }
    
    /**
     * Détache une feuille excel du document si celle-ci est attaché
     * @param Worksheet $sheet Feuille excel à détacher
     * @return boolean Retourne vrai si la feuille était attaché et a bien été détaché
     * ou false si la feuille n'était pas attaché
     */
    protected function detachSheetToDoc($sheet) {
        $sheet_index = $this->getExcelDoc()->getIndex(
                $this->getExcelDoc()->getSheetByName($sheet->getTitle()));
        if($sheet_index === NULL)
        {
            return FALSE;
        }
        $this->getExcelDoc()->removeSheetByIndex($sheet_index);
        return TRUE;
    }
    
    protected function saveDocument() {
        $writer = new \PHPExcel_Writer_Excel2007($this->getExcelDoc());
        $writer->save(self::SAVE_PATH . $this->getTypeItem() .'.xlsx');
    }
//</editor-fold>

//<editor-fold defaultstate="collapsed" desc="getter&setter">
    /**
     * Retourne le lien vers le document excel
     * @return string
     */
    public function getLink() {
        return self::SAVE_PATH . $this->getTypeItem() .'.xlsx';
    }

    public function getExcelDoc() {
        return $this->_excel_doc;
    }
    
    public function setExcelDoc($excel_doc) {
        $this->_excel_doc = $excel_doc;
        $this->_excel_doc->removeSheetByIndex(0);
    }
    
    /**
     * 
     * @return SheetExcel
     */
    public function getSheetExcel() {
        return $this->_sheet_excel;
    }
    
    /**
     * 
     * @param ExcelSheet $sheet
     */
    public function setSheetExcel($sheet) {
        $this->_sheet_excel = $sheet;
    }
    
    public function getTypeItem() {
        return $this->_type_item;
    }
    
    /**
     * 
     * @param string $type_item 
     * @throws Exception
     */
    public function setTypeItem($type_item) {
        if(!$this->typeItemExist($type_item))
        {
            throw new Exception("Type de l'item non pris en charge!");
        }
        $this->_type_item = $type_item;
    }
    
    /**
     * Verifie que le type de l'item est gérer par la class
     * @param string $type_item type de l'item
     * @return boolean
     */
    protected function typeItemExist($type_item) {
        return in_array($type_item, self::$ITEM_ACCEPTED);
    }
//</editor-fold>
}
