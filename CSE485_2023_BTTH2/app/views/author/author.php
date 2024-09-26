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
                <a href="index.php?controller=Author&action=create" class="btn btn-success">Thêm mới</a>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Ảnh</th>
                            <th scope="col">Tên tác giả</th>
                            <th>Sửa</th>
                            <th>Xóa</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (empty($authors)) {
                            echo "<tr><td colspan='4'>No authors found</td></tr>";
                        } else {
                            foreach ($authors as $key => $author) :
                        ?>
                                <tr>
                                    <th scope="row"><?php echo $key + 1 ?></th>
                                    <td><img src="..<?php echo $author->getImgUrl(); ?>" alt="<?php echo $author->getName(); ?>" style="width: 100px; height: 100px;"></td>
                                    <td><?php echo $author->getName(); ?></td>
                                    <td><a href="index.php?controller=Author&action=edit&id=<?php echo $author->getId(); ?>" class="btn btn-primary"><i class="fas fa-edit"></i></a></td>
                                    <td><a href="index.php?controller=Author&action=delete&id=<?php echo $author->getId(); ?>" class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa không?')"><i class="fas fa-trash"></i></a></td>
                                </tr>
                        <?php
                            endforeach;
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>
    <footer class="bg-white d-flex justify-content-center align-items-center border-top border-secondary  border-2" style="height:80px">
        <h4 class="text-center text-uppercase fw-bold">TLU's music garden</h4>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>

</html>