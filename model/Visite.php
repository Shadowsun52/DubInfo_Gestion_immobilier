<?php
namespace DubInfo_gestion_immobilier\model;

use DubInfo_gestion_immobilier\Exception\StringAttributeTooLong;
use DubInfo_gestion_immobilier\Exception\BadTypeException;
use DubInfo_gestion_immobilier\Exception\ReadOusideArrayException;

/**
 * Description of Visite
 *
 * @author Jenicot Alexandre
 */
abstract class Visite implements \JsonSerializable{
    const MAX_SIZE_RAPPORT = 500;
    
    /**
     * @var int 
     */
    private $_id;
    
    /**
     * @var DateTime 
     */
    private $_date;
    
    /**
     * @var string 
     */
    private $_rapport;
    
    /**
     * Liste des membre du personnel ayant participé à la visite
     * @var array[User] 
     */
    private $_participants;
    
    /**
     * 
     * @param int $id
     * @param DateTime $date
     * @param string $rapport
     * @param array[User] $participants Liste des membre du personnel ayant participé à la visite
     * @throws BadTypeException
     * @throws StringAttributeTooLong
     */
    public function __construct($id = NULL, $date = NULL, $rapport = NULL, $participants = NULL) {
        $this->setId($id);
        $this->setDate($date);
        $this->setRapport($rapport);
        $this->setParticipants($participants);
    }
    
    /**
     * 
     * @return int
     */
    public function getId() {
        return $this->_id;
    }
    
    /**
     * 
     * @param int $id
     * @throws BadTypeException
     */
    public function setId($id) {
        $this->_id = CheckTyper::isInteger($id, 'id', __CLASS__);
    }
    
    /**
     * 
     * @return DateTime
     */
    public function getDate() {
        return $this->_date;
    }
    
    /**
     * 
     * @param DateTime $date
     * @throws BadTypeException
     */
    public function setDate($date) {
        $this->_date = CheckTyper::isDateTime($date, 'date', __CLASS__);
    }
    
    /**
     * 
     * @return string
     */
    public function getRapport() {
        return $this->_rapport;
    }
    
    /**
     * 
     * @param string $rapport
     * @throws BadTypeException
     * @throws StringAttributeTooLong
     */
    public function setRapport($rapport) {
        $_rapport = CheckTyper::isString($rapport, 'rapport', __CLASS__);
        
        if(strlen($_rapport) > self::MAX_SIZE_RAPPORT) {
            throw new StringAttributeTooLong('rapport', __CLASS__);
        }
        
        $this->_rapport = $_rapport;
    }
    
    /**
     * 
     * @return array[User]
     */
    public function getParticipants() {
        return $this->_participants;
    }
    
    /**
     * 
     * @param array[User] $participants
     * @throws BadTypeException
     */
    public function setParticipants($participants) {
        $this->_participants = CheckTyper::isArrayOfModel($participants, User::class,
                'Participants', __CLASS__);
    }
    
    /**
     * 
     * @param int $id index de la valeur dans le tableau
     * @return User
     * @throws ReadOusideArrayException
     */
    public function getParticipant($id) {
        if($id < count($this->_participants)) {
            return $this->_participants[$id];
        }
        
        throw new ReadOusideArrayException('Participants', __CLASS__);
    }
    
    /**
     * 
     * @param User $participant
     * @throws BadTypeException
     */
    public function addParticipant($participant) {
        $this->_participants[] = CheckTyper::isModel($participant, User::class, 
                'Participant', __CLASS__);
    }
    
    public function jsonSerialize() {
        return [
            'id' => $this->getId(),
            'date' => ($this->getDate() == NULL)? NULL : $this->getDate()->format('d-m-Y'),
            'rapport' => $this->getRapport(),
            'participants' => $this->getParticipants(),
            'toString' => $this->toString()
        ];
    }
    
    /**
     *
     * @return string
     */
    public function toString() {
        return $this->getDate();
    }
}
