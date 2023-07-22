<!DOCTYPE html>
<html>
<head>
    <title>Quản lý danh sách sách</title>
</head>
<body>
    <h1>Quản lý danh sách sách</h1>

    <!-- Form thêm sách mới -->
    <div>
        <h2>Thêm sách mới:</h2>
        <form action="index.php" method="post">
            <label for="title">Tên sách:</label>
            <input type="text" id="title" name="title" required><br>

            <label for="author">Tên tác giả:</label>
            <input type="text" id="author" name="author" required><br>

            <label for="publisher">Nhà xuất bản:</label>
            <input type="text" id="publisher" name="publisher" required><br>

            <label for="publicationYear">Năm xuất bản:</label>
            <input type="number" id="publicationYear" name="publicationYear" required><br>

            <label for="ISBN">Số hiệu ISBN:</label>
            <input type="text" id="ISBN" name="ISBN" required><br>

            <label for="chapterList">Danh mục các chương (ngăn cách bằng dấu phẩy):</label>
            <input type="text" id="chapterList" name="chapterList" required><br>

            <button type="submit">Thêm sách</button>
        </form>
    </div>

    <!-- Danh sách sách -->
    <div>
        <h2>Danh sách sách:</h2>
        <form action="index.php" method="post">
            <button type="submit" name="sortByAuthor">Sắp xếp theo tên tác giả</button>
            <button type="submit" name="sortByTitle">Sắp xếp theo tên sách</button>
            <button type="submit" name="sortByPublicationYear">Sắp xếp theo năm xuất bản</button>
        </form>

        <?php
        include('Book.php');
        include('BookList.php');

        session_start();

        // Kiểm tra nút submit đã được nhấn
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $title = $_POST['title'];
            $author = $_POST['author'];
            $publisher = $_POST['publisher'];
            $publicationYear = $_POST['publicationYear'];
            $ISBN = $_POST['ISBN'];
            $chapterList = $_POST['chapterList'];

            $book = new Book($title, $author, $publisher, $publicationYear, $ISBN, $chapterList);
            $bookList = isset($_SESSION['bookList']) ? $_SESSION['bookList'] : new BookList();
            $bookList->addBook($book);

            $_SESSION['bookList'] = $bookList;
        }

        // Kiểm tra nút sắp xếp đã được nhấn
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $bookList = $_SESSION['bookList'];
            if (isset($_POST['sortByAuthor'])) {
                $bookList->sortByAuthor();
            } elseif (isset($_POST['sortByTitle'])) {
                $bookList->sortByTitle();
            } elseif (isset($_POST['sortByPublicationYear'])) {
                $bookList->sortByPublicationYear();
            }
            $_SESSION['bookList'] = $bookList;
        }

        // Hiển thị danh sách sách
        if (isset($_SESSION['bookList'])) {
            $bookList = $_SESSION['bookList'];
            foreach ($bookList->getBooks() as $book) {
                echo '<strong>' . $book->getTitle() . '</strong> - ' . $book->getAuthor() . ' (' . $book->getPublicationYear() . ')';
                $chapters = $book->getChapterList();
                if (!empty($chapters)) {
                    echo '<ul>';
                    foreach ($chapters as $chapter) {
                        echo '<li>' . $chapter . '</li>';
                    }
                    echo '</ul>';
                }
                echo '<br>';
            }
        }
        ?>
    </div>
</body>
</html>