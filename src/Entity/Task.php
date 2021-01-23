<?php

namespace App\Entity;

use App\Repository\TaskRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=TaskRepository::class)
 */
class Task
{
    public const STATUS_COMPLETED = 'completed';
    public const STATUS_IN_PROGRESS = 'in progress';
    public const STATUS_NOT_STARTED = 'not started';

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     */
    private $status;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $timeSpent;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $startDate;

    /**
     * @ORM\ManyToOne(targetEntity=Owner::class, inversedBy="tasks")
     */
    private $owner;

    /**
     * @ORM\ManyToOne(targetEntity=Category::class, inversedBy="tasks")
     * @ORM\JoinColumn(nullable=false)
     */
    private $category;

    /**
     * @ORM\ManyToOne(targetEntity=Board::class, inversedBy="tasks")
     */
    private $board;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }


    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getTimeSpent(): ?\DateTimeInterface
    {
        return $this->timeSpent;
    }

    public function setTimeSpent(?\DateTimeInterface $timeSpent): self
    {
        $this->timeSpent = $timeSpent;

        return $this;
    }

    public function getStartDate(): ?\DateTimeInterface
    {
        return $this->startDate;
    }

    public function setStartDate(?\DateTimeInterface $startDate): self
    {
        $this->startDate = $startDate;

        return $this;
    }

    public function getOwner(): ?Owner
    {
        return $this->owner;
    }

    public function setOwner(?Owner $owner): self
    {
        $this->owner = $owner;

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): self
    {
        $this->category = $category;

        return $this;
    }

    public function getStatuses(): array
    {
        return [
            self::STATUS_COMPLETED,
            self::STATUS_IN_PROGRESS,
            self::STATUS_NOT_STARTED,
        ];
    }

    public function __toString()
    {
        return $this->title;
    }

    public function getBoard(): ?Board
    {
        return $this->board;
    }

    public function setBoard(?Board $board): self
    {
        $this->board = $board;

        return $this;
    }
}
