<?php

namespace Ezap\PublicBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Comments
 *
 * @ORM\Table(name="comments", indexes={@ORM\Index(name="user_id", columns={"user_id"})})
 * @ORM\Entity
 */
class Comments
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="note", type="integer", nullable=true)
     */
    private $note;

    /**
     * @var string
     *
     * @ORM\Column(name="content", type="text", nullable=true)
     */
    private $content;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_created", type="datetime", nullable=true)
     */
    private $dateCreated;

    /**
     * @var \User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     * })
     */
    private $user;


    /**
     * @ORM\ManyToOne(targetEntity="Movies", inversedBy="comments")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="movies_id", referencedColumnName="id")
     * })
     */
    private $movie;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set note
     *
     * @param integer $note
     * @return Comments
     */
    public function setNote($note)
    {
        $this->note = $note;

        return $this;
    }

    /**
     * Get note
     *
     * @return integer 
     */
    public function getNote()
    {
        return $this->note;
    }

    /**
     * Set content
     *
     * @param string $content
     * @return Comments
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string 
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set dateCreated
     *
     * @param \DateTime $dateCreated
     * @return Comments
     */
    public function setDateCreated($dateCreated)
    {
        $this->dateCreated = $dateCreated;

        return $this;
    }

    /**
     * Get dateCreated
     *
     * @return \DateTime 
     */
    public function getDateCreated()
    {
        return $this->dateCreated;
    }

    /**
     * Set user
     *
     * @param \Ezap\PublicBundle\Entity\User $user
     * @return Comments
     */
    public function setUser(\Ezap\PublicBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \Ezap\PublicBundle\Entity\User 
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set movie
     *
     * @param \Ezap\PublicBundle\Entity\Movies $movie
     * @return Comments
     */
    public function setMovie(\Ezap\PublicBundle\Entity\Movies $movie = null)
    {
        $this->movie = $movie;

        return $this;
    }

    /**
     * Get movie
     *
     * @return \Ezap\PublicBundle\Entity\Movies 
     */
    public function getMovie()
    {
        return $this->movie;
    }


    /**
     * @return string
     */
    public function __toString(){
        return $this->getId();
    }


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->dateCreated = new \Datetime('now');

    }
}
