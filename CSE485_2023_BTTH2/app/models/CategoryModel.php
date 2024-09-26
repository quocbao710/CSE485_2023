<?php
class CategoryModel
{
    private int $id;
    private string $name;

    public function __construct(int $id, string $name)
    {
        $this->setId($id);
        $this->setName($name);
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        if ($id <= 0) {
            throw new InvalidArgumentException("ID must be a positive integer.");
        }
        $this->id = $id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        if (empty($name)) {
            throw new InvalidArgumentException("Name cannot be empty.");
        }
        $this->name = $name;
    }

    public function __toString(): string
    {
        return $this->name;
    }
}
