<?php
class AuthorModel
{
    private int $id;
    private string $name;
    private string $imgUrl;

    public function __construct(int $id, string $name, ?string $imgUrl)
    {
        $this->setId($id);
        $this->setName($name);
        $this->setImgUrl($imgUrl ?? '');
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

    public function getImgUrl(): string
    {
        return $this->imgUrl;
    }

    public function setImgUrl(string $imgUrl): void
    {
        // if (empty($imgUrl)) {
        //     throw new InvalidArgumentException("Image URL cannot be empty.");
        // }
        $this->imgUrl = $imgUrl;
    }

    public function __toString(): string
    {
        return $this->name;
    }
}
