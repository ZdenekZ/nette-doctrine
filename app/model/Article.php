<?php

namespace App;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="articlesss")
 */
class Article extends \Kdyby\Doctrine\Entities\BaseEntity
{

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    protected $id;

    /**
     * @ORM\Column(type="string")
     */
    protected $title;

    /**
     * @ORM\Column(type="string")
     */
    protected $content;

    /**
     * @ORM\ManyToOne(targetEntity="Blog", inversedBy="articles")
     * @var Blog
     */
    protected $blog;

    /**
     * Article constructor.
     * @param Blog $blog
     * @param string $title
     * @param string $content
     */
    public function __construct(Blog $blog, $title, $content)
    {
        $this->blog = $blog;
        $this->title = $title;
        $this->content = $content;

        $blog->addArticle($this);
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @return mixed
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @return Blog
     */
    public function getBlog()
    {
        return $this->blog;
    }


}