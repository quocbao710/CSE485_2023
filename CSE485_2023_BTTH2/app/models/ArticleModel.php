<?php
class ArticleModel
{
    private int $id;
    private string $title;
    private string $nameSong;
    private int $categoryId;
    private string $summary;
    private string $content;
    private int $authorId;
    private string $imgUrl;

    public function __construct(int $id, string $title, string $nameSong, int $categoryId, string $summary, ?string $content, int $authorId, ?string $imgUrl)
    {
        $this->setId($id);
        $this->setTitle($title);
        $this->setNameSong($nameSong);
        $this->setCategoryId($categoryId);
        $this->setSummary($summary);
        $this->setContent($content ?? '');
        $this->setAuthorId($authorId);
        $this->setImgUrl($imgUrl ?? '');
    }

    public function setId(int $id): void
    {
        if ($id <= 0) {
            throw new InvalidArgumentException("ID must be a positive integer.");
        }
        $this->id = $id;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        if (empty($title)) {
            throw new InvalidArgumentException("Title cannot be empty.");
        }
        $this->title = $title;
    }

    public function getNameSong(): string
    {
        return $this->nameSong;
    }

    public function setNameSong(string $nameSong): void
    {
        if (empty($nameSong)) {
            throw new InvalidArgumentException("Name song cannot be empty.");
        }
        $this->nameSong = $nameSong;
    }

    public function getCategoryId(): int
    {
        return $this->categoryId;
    }

    public function setCategoryId(int $categoryId): void
    {
        if ($categoryId <= 0) {
            throw new InvalidArgumentException("Category ID must be a positive integer.");
        }
        $this->categoryId = $categoryId;
    }

    public function getSummary(): string
    {
        return $this->summary;
    }

    public function setSummary(string $summary): void
    {
        if (empty($summary)) {
            throw new InvalidArgumentException("Summary cannot be empty.");
        }
        $this->summary = $summary;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function setContent(string $content): void
    {
        $this->content = $content;
    }

    public function getAuthorId(): int
    {
        return $this->authorId;
    }

    public function setAuthorId(int $authorId): void
    {
        if ($authorId <= 0) {
            throw new InvalidArgumentException("Author ID must be a positive integer.");
        }
        $this->authorId = $authorId;
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
        return $this->title;
    }

    public function __toArray(): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'nameSong' => $this->nameSong,
            'categoryId' => $this->categoryId,
            'summary' => $this->summary,
            'content' => $this->content,
            'authorId' => $this->authorId,
            'imgUrl' => $this->imgUrl
        ];
    }
}

class ArticleViewModel{
    private int $id;
    private string $title;
    private string $nameSong;
    private string $categoryName;
    private string $summary;
    private string $content;
    private string $authorName;
    private string $createdDate;
    private string $imgUrl;

    public function __construct(int $id, string $title, string $nameSong, string $categoryName, string $summary, ?string $content, string $authorName, string $createdDate, ?string $imgUrl)
    {
        $this->setId($id);
        $this->setTitle($title);
        $this->setNameSong($nameSong);
        $this->setCategoryName($categoryName);
        $this->setSummary($summary);
        $this->setContent($content ?? '');
        $this->setAuthorName($authorName);
        $this->setCreatedDate($createdDate);
        $this->setImgUrl($imgUrl ?? '');
    }

    public function setId(int $id): void
    {
        if ($id <= 0) {
            throw new InvalidArgumentException("ID must be a positive integer.");
        }
        $this->id = $id;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        if (empty($title)) {
            throw new InvalidArgumentException("Title cannot be empty.");
        }
        $this->title = $title;
    }

    public function getNameSong(): string
    {
        return $this->nameSong;
    }

    public function setNameSong(string $nameSong): void
    {
        if (empty($nameSong)) {
            throw new InvalidArgumentException("Name song cannot be empty.");
        }
        $this->nameSong = $nameSong;
    }

    public function getCategoryName(): string
    {
        return $this->categoryName;
    }

    public function setCategoryName(string $categoryName): void
    {
        if (empty($categoryName)) {
            throw new InvalidArgumentException("Category name cannot be empty.");
        }
        $this->categoryName = $categoryName;
    }

    public function getSummary(): string
    {
        return $this->summary;
    }

    public function setSummary(string $summary): void
    {
        if (empty($summary)) {
            throw new InvalidArgumentException("Summary cannot be empty.");
        }
        $this->summary = $summary;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function setContent(string $content): void
    {
        $this->content = $content;
    }

    public function getAuthorName(): string
    {
        return $this->authorName;
    }

    public function setAuthorName(string $authorName): void
    {
        if (empty($authorName)) {
            throw new InvalidArgumentException("Author name cannot be empty.");
        }
        $this->authorName = $authorName;
    }

    public function getCreatedDate(): string
    {
        return $this->createdDate;
    }

    public function setCreatedDate(string $createdDate): void
    {
        if (empty($createdDate)) {
            throw new InvalidArgumentException("Created date cannot be empty.");
        }
        $this->createdDate = $createdDate;
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
        return $this->title;
    }

    public function __toArray(): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'nameSong' => $this->nameSong,
            'categoryName' => $this->categoryName,
            'summary' => $this->summary,
            'content' => $this->content,
            'authorName' => $this->authorName,
            'createdDate' => $this->createdDate,
            'imgUrl' => $this->imgUrl
        ];
    }

}