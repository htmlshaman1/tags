<?php
// src/Entity/Article.php
namespace App\Entity;

use Beelab\TagBundle\Tag\TaggableInterface;
use Beelab\TagBundle\Tag\TagInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table()
 * @ORM\Entity()
 */
class Article implements TaggableInterface
{

     /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    
    
    /**
     * @ORM\Column(type="text")
    */
    private $body;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Tag")
     */
    private $tags;

    // note: if you generated code, you need to
    // replace "Tag" with "TagInterface" where appropriate

    public function __construct()
    {
        $this->tags = new ArrayCollection();
    }

    public function addTag(TagInterface $tag): void
    {
        if (!$this->tags->contains($tag)) {
            $this->tags->add($tag);
        }
    }

    public function removeTag(TagInterface $tag): void
    {
        $this->tags->removeElement($tag);
    }

    public function hasTag(TagInterface $tag): bool
    {
        return $this->tags->contains($tag);
    }

    public function getTags(): iterable
    {
        return $this->tags;
    }

    public function getTagNames(): array
    {
        return empty($this->tagsText) ? [] : \array_map('trim', explode(',', $this->tagsText));
    }
    
    
    public function setBody($body) {
      $this->body = $body;
    }
    
    
    public function getBody() {
      return $this->body;
    }
    
    
}
