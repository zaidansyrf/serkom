// script.js
document.addEventListener("DOMContentLoaded", () => {
    const ipkInput = document.getElementById("ipk");
    const beasiswaSelect = document.getElementById("beasiswa");
    const berkasInput = document.getElementById("berkas");
    const daftarBtn = document.getElementById("daftarBtn");
    const form = document.getElementById("registrasiForm");
    const hasilTable = document.getElementById("hasilTable");
  
    const IPK = parseFloat(ipkInput.value);
  
    // Enable or disable elements based on IPK
    if (IPK >= 3.0) {
      beasiswaSelect.disabled = false;
      berkasInput.disabled = false;
      daftarBtn.disabled = false;
    } else {
      alert("IPK Anda di bawah 3.0. Anda tidak memenuhi syarat untuk mendaftar beasiswa.");
    }
  
    // Form submission
    form.addEventListener("submit", (e) => {
      e.preventDefault();
  
      const nama = document.getElementById("nama").value;
      const email = document.getElementById("email").value;
      const hp = document.getElementById("hp").value;
      const semester = document.getElementById("semester").value;
      const beasiswa = beasiswaSelect.value;
  
      const newRow = `
        <tr>
          <td>${nama}</td>
          <td>${email}</td>
          <td>${hp}</td>
          <td>${semester}</td>
          <td>${IPK}</td>
          <td>${beasiswa}</td>
          <td>Belum Diverifikasi</td>
        </tr>
      `;
      hasilTable.innerHTML += newRow;
  
      form.reset();
      alert("Pendaftaran berhasil!");
    });
  
    // Reset button
    form.addEventListener("reset", () => {
      alert("Form telah direset.");
    });
  });

  document.getElementById("daftarBtn").addEventListener("click", function () {
    const form = document.getElementById("registrasiForm");
    const formData = new FormData(form);
  
    formData.append("status_ajuan", "belum diverifikasi");
  
    // Kirim data ke PHP
    fetch("proses_daftar.php", {
      method: "POST",
      body: formData,
    })
      .then((response) => response.json())
      .then((data) => {
        if (data.success) {
          alert("Data berhasil disimpan!");
          window.location.href = "hasil.php";
        } else {
          alert("Gagal menyimpan data!");
        }
      })
      .catch((error) => console.error("Error:", error));
  });
  
  document.getElementById("batalBtn").addEventListener("click", function () {
    document.getElementById("registrasiForm").reset();
  });
  