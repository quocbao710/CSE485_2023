<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Music for Life</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../../css/style_login.css">
</head>

<body>
    <?php require_once __DIR__ . '../../../../global/layout/header.php' ?>

    <main class="container mt-5 mb-5">
        <div class="row">
            <div class="col-sm">
                <h3 class="text-center text-uppercase fw-bold">Sửa thông tin bài viết</h3>
                <form action="index.php?controller=Article&action=update" method="post" enctype="multipart/form-data">
                    <div class="input-group mt-3 mb-3">
                        <span class="input-group-text">Mã bài viết</span>
                        <?php
                        echo '<input type="text" class="form-control" name="id" value="' . $article->getId() . '" readonly>';
                        ?>
                    </div>
                    <div class="input-group mt-3 mb-3">
                        <span class="input-group-text">Tiêu đề</span>
                        <?php
                        echo '<input type="text" class="form-control" name="title" value="' . $article->getTitle() . '">';
                        ?>
                    </div>
                    <div class="input-group mt-3 mb-3">
                        <span class="input-group-text">Tên bài hát</span>
                        <?php
                        echo '<input type="text" class="form-control" name="songName" value="' . $article->getNameSong() . '">';
                        ?>
                    </div>
                    <div class="input-group mt-3 mb-3">
                        <span class="input-group-text">Thể loại</span>
                        <select class="form-select" id="categoryId" name="categoryId" require>
                            <option selected>-- Chọn thể loại --</option>
                            <?php
                            if ($categories) {
                                foreach ($categories as $category) {
                                    if ($category->getId() === $article->getCategoryId()) {
                                        echo '<option value="' . $category->getId() . '" selected>' . $category->getName() . '</option>';
                                    } else {
                                        echo '<option value="' . $category->getId() . '">' . $category->getName() . '</option>';
                                    }
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <div class="input-group mt-3 mb-3">
                        <span class="input-group-text">Tóm tắt</span>
                        <textarea rows="3" class="form-control" name="summary"><?php echo $article->getSummary(); ?></textarea>
                    </div>
                    <div class="input-group mt-3 mb-3">
                        <span class="input-group-text">Nội dung</span>
                        <textarea rows="5" class="form-control" name="content"><?php echo $article->getContent(); ?></textarea>
                    </div>
                    <div class="input-group mt-3 mb-3">
                        <span class="input-group-text">Tác giả</span>
                        <select class="form-select" id="authorId" name="authorId" require>
                            <option selected>-- Chọn tác giả --</option>
                            <?php
                            if ($authors) {
                                foreach ($authors as $author) {
                                    if ($author->getId() === $article->getAuthorId()) {
                                        echo '<option value="' . $author->getId() . '" selected>' . $author->getName() . '</option>';
                                    } else {
                                        echo '<option value="' . $author->getId() . '">' . $author->getName() . '</option>';
                                    }
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <div class="input-group mt-3 mb-3">
                        <span class="input-group-text">Ảnh</span>
                        <?php
                        echo '<input type="file" class="form-control" id="inputGroupFile02" name="fileArticleImage" accept="image/jpeg,image/jpg,image/png">';
                        ?>
                    </div>
                    <div class="form-group float-end">
                        <input type="submit" value="Lưu lại" class="btn btn-success">
                        <a href="index.php?controller=Article&action=index" class="btn btn-warning ">Quay lại</a>
                    </div>
                </form>
            </div>
        </div>
    </main>
    <footer class="bg-white d-flex justify-content-center align-items-center border-top border-secondary  border-2" style="height:80px">
        <h4 class="text-center text-uppercase fw-bold">TLU's music garden</h4>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>

</html>