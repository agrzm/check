<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Instagram Kullanıcı Adı Kontrol Botu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2 class="text-center">Instagram Kullanıcı Adı Kontrol Botu</h2>
    <form action="bot.php" method="post" class="mb-3">
        <div class="mb-3">
            <label for="length" class="form-label">Kullanıcı Adı Uzunluğu</label>
            <input type="number" name="length" id="length" class="form-control" required min="3" max="30">
        </div>
        <div class="mb-3">
            <label for="usernameType" class="form-label">Kullanıcı Adı Türü</label>
            <select name="usernameType" id="usernameType" class="form-control" required>
                <option value="letters">Sadece Harf</option>
                <option value="numbers">Sadece Sayı</option>
                <option value="both">Harf ve Sayı</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Kullanıcı Adlarını Kontrol Et</button>
    </form>
    <div class="row">
        <div class="col-md-6">
            <h5>Boştaki Kullanıcı Adları</h5>
            <textarea id="availableUsernames" class="form-control" rows="10" readonly></textarea>
        </div>
        <div class="col-md-6">
            <h5>Dolu Olan Kullanıcı Adları</h5>
            <textarea id="takenUsernames" class="form-control" rows="10" readonly></textarea>
        </div>
    </div>
</div>

<br>
<center><h1>AGRZM</h1></center>
<script>
    document.querySelector('form').onsubmit = async function (e) {
        e.preventDefault();

        const button = e.target.querySelector('button');
        button.disabled = true;
        button.textContent = 'İşleniyor...';

        const formData = new FormData(e.target);
        const response = await fetch('bot.php', {
            method: 'POST',
            body: formData
        });
        const result = await response.json();

        document.getElementById('availableUsernames').value = result.available.join("\n");
        document.getElementById('takenUsernames').value = result.taken.join("\n");

        button.disabled = false;
        button.textContent = 'Kullanıcı Adlarını Kontrol Et';
    };
</script>

</body>
</html>
