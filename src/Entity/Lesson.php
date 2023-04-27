<?php

namespace App\Entity;

use App\Repository\LessonRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=LessonRepository::class)
 */
class Lesson
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Course::class, inversedBy="lessons_list")
     * @ORM\JoinColumn(nullable=false)
     */
    private $course_code;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=1000)
     */
    private $content;

    /**
     * @ORM\Column(type="integer")
     */
    private $lesson_number;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCourseCode(): ?Course
    {
        return $this->course_code;
    }

    public function setCourseCode(?Course $course_code): self
    {
        $this->course_code = $course_code;

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

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getLessonNumber(): ?int
    {
        return $this->lesson_number;
    }

    public function setLessonNumber(int $lesson_number): self
    {
        $this->lesson_number = $lesson_number;

        return $this;
    }
}
