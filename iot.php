 <?php
    $iot = mysqli_connect("localhost", "root", "", "belajariot");

    // Cek Koneksi
    if (mysqli_connect_errno()) {
        echo "Koneksi database gagal : " . mysqli_connect_error();
    }

    echo "Koneksi successfully";

    // Insert Data 
    $sql = "INSERT INTO iot (soil) VALUES (56)";
    if (mysqli_query($iot, $sql)) {
        echo " New Insert successfully";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($iot);
    }
    mysqli_close($iot);

    ?>


