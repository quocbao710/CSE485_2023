<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../../css/style_login.css">
</head>

<body>
    <?php require_once __DIR__ . '../../../../global/layout/header.php' ?>

    <main class="container mt-5 mb-5">
        <div class="row">
            <div class="col-sm">
                <h3 class="text-center text-uppercase fw-bold">Thêm mới thông tin bài viết</h3>
                <?php if (!empty($message)): ?>
                    <div class="alert alert-warning text-center mt-3">
                        <?php echo $message; ?>
                    </div>
                <?php endif; ?>
                <form action="index.php?controller=Article&action=store" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="title">Tiêu đề</label>
                        <input type="text" class="form-control" id="title" name="title" required>
                    </div>
                    <div class="form-group">
                        <label for="songName">Tên bài hát</label>
                        <input type="text" class="form-control" id="songName" name="songName" required>
                    </div>
                    <div class="form-group">
                        <label for="categoryId">Thể loại</label>
                        <select class="form-select" id="categoryId" name="categoryId" required>
                            <option selected>-- Chọn thể loại --</option>
                            <?php
                            foreach ($categories as $category) {
                                echo '<option value="' . $category->getId() . '">' . $category->getName() . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="summary">Tóm tắt</label>
                        <textarea class="form-control" id="summary" name="summary" rows="3" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="content">Nội dung</label>
                        <textarea class="form-control" id="content" name="content" rows="5"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="authorId">Tác giả</label>
                        <select class="form-select" id="authorId" name="authorId" required>
                            <option selected>-- Chọn tác giả --</option>
                            <?php
                            foreach ($authors as $author) {
                                echo '<option value="' . $author->getId() . '">' . $author->getName() . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="image">Ảnh</label>
                        <input type="file" class="form-control" id="fileArticleImage" name="fileArticleImage" accept="image/jpeg,image/jpg,image/png" required>
                    </div>
                    <div class="form-group float-end mt-3">
                        <input type="submit" value="Thêm" class="btn btn-success">
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