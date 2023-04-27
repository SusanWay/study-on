<?php

namespace App\Entity;

use App\Repository\CourseRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CourseRepository::class)
 */
class Course
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $char_code;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=1000, nullable=true)
     */
    private $content;

    /**
     * @ORM\OneToMany(targetEntity=Lesson::class, mappedBy="course_code")
     */
    private $lessons_list;

    public function __construct()
    {
        $this->lessons_list = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCharCode(): ?string
    {
        return $this->char_code;
    }

    public function setCharCode(string $char_code): self
    {
        $this->char_code = $char_code;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(?string $content): self
    {
        $this->content = $content;

        return $this;
    }

    /**
     * @return Collection<int, Lesson>
     */
    public function getLessonsList(): Collection
    {
        return $this->lessons_list;
    }

    public function addLessonsList(Lesson $lessonsList): self
    {
        if (!$this->lessons_list->contains($lessonsList)) {
            $this->lessons_list[] = $lessonsList;
            $lessonsList->setCourseCode($this);
        }

        return $this;
    }

    public function removeLessonsList(Lesson $lessonsList): self
    {
        if ($this->lessons_list->removeElement($lessonsList)) {
            // set the owning side to null (unless already changed)
            if ($lessonsList->getCourseCode() === $this) {
                $lessonsList->setCourseCode(null);
            }
        }

        return $this;
    }
}
