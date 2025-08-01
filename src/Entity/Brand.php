<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use App\Repository\BrandRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=BrandRepository::class)
 * @ApiResource(
 *  normalizationContext={"groups"={"brand:list"}, "enable_max_depth"=true},
 *  denormalizationContext={"groups"={"brand:create"}, "enable_max_depth"=true}
 * )
 */
#[ApiResource(
    normalizationContext: [
        'groups' => ["brand:list"],
        'enable_max_depth'=>true,
    ],
    denormalizationContext: [
        'groups' => ['brand:create'],
        'enable_max_depth' => true,
    ]
)]
#[ApiFilter(SearchFilter::class, properties: ['name' => 'exact'])]
class Brand
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"brand:create", "brand:list", "product:brand:list"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"brand:create", "brand:list", "product:brand:list"})
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"brand:create", "brand:list", "product:brand:list"})
     */
    private $logo;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getLogo(): ?string
    {
        return $this->logo;
    }

    public function setLogo(string $logo): self
    {
        $this->logo = $logo;

        return $this;
    }
}
