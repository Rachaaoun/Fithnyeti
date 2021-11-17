<?php

namespace App\Entity;

use App\Repository\ComplainttypeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ComplainttypeRepository::class)
 */
class Complainttype
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
    private $type;

    /**
     * @ORM\OneToMany(targetEntity=Complaint::class, mappedBy="complainttype")
     */
    private $complaint;

    public function __construct()
    {
        $this->complaint = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return Collection|Complaint[]
     */
    public function getComplaint(): Collection
    {
        return $this->complaint;
    }

    public function addComplaint(Complaint $complaint): self
    {
        if (!$this->complaint->contains($complaint)) {
            $this->complaint[] = $complaint;
            $complaint->setComplainttype($this);
        }

        return $this;
    }

    public function removeComplaint(Complaint $complaint): self
    {
        if ($this->complaint->removeElement($complaint)) {
            // set the owning side to null (unless already changed)
            if ($complaint->getComplainttype() === $this) {
                $complaint->setComplainttype(null);
            }
        }

        return $this;
    }

    public function __toString(){
        return $this->getType();
    }
}
