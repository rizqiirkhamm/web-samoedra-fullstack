// Custom JavaScript untuk halaman artikel saja
// File ini dibuat untuk menangani editor Summernote dan fungsi-fungsi modal

document.addEventListener("DOMContentLoaded", function () {
    // Periksa apakah Summernote sudah diinisialisasi di halaman artikel master
    if (typeof window.summernoteInitialized === "undefined") {
        // Inisialisasi Summernote jika jQuery tersedia
        if (typeof $ !== "undefined" && $.fn.summernote) {
            // Inisialisasi Summernote untuk semua editor class basic-editor
            $(".basic-editor").summernote({
                placeholder: "Tulis konten di sini...",
                tabsize: 2,
                height: 200,
                toolbar: [
                    ["style", ["style"]],
                    ["font", ["bold", "underline", "italic", "clear"]],
                    ["para", ["ul", "ol", "paragraph"]],
                    ["insert", ["link"]],
                    ["view", ["fullscreen", "codeview"]],
                ],
                callbacks: {
                    onImageUpload: function (files) {
                        // Upload gambar ke server
                        for (let i = 0; i < files.length; i++) {
                            uploadImage(files[i], $(this));
                        }
                    },
                },
            });

            // Set dark mode jika diperlukan
            if (document.documentElement.classList.contains("dark")) {
                $(".note-editor").addClass("dark-mode");
            }

            console.log("Summernote tersedia");
        } else {
            console.log("jQuery atau Summernote tidak tersedia");
        }
    } else {
        console.log("Summernote sudah diinisialisasi di tempat lain");
    }

    // Fungsi untuk menampilkan modal tambah artikel
    if (typeof window.showAddModal === "undefined") {
        window.showAddModal = function () {
            document.getElementById("articleModal").classList.remove("hidden");

            // Pastikan Summernote diinisialisasi ketika modal ditampilkan
            if (
                typeof window.summernoteInitialized === "undefined" &&
                typeof $ !== "undefined" &&
                $.fn.summernote
            ) {
                setTimeout(function () {
                    $("#summernote").summernote({
                        placeholder: "Tulis konten artikel di sini...",
                        tabsize: 2,
                        height: 300,
                        toolbar: [
                            ["style", ["style"]],
                            ["font", ["bold", "underline", "italic", "clear"]],
                            ["fontname", ["fontname"]],
                            ["fontsize", ["fontsize"]],
                            ["color", ["color"]],
                            ["para", ["ul", "ol", "paragraph"]],
                            ["table", ["table"]],
                            ["insert", ["link", "picture", "video"]],
                            ["view", ["fullscreen", "codeview", "help"]],
                        ],
                        fontNames: [
                            "Arial",
                            "Arial Black",
                            "Comic Sans MS",
                            "Courier New",
                            "Helvetica",
                            "Times New Roman",
                        ],
                        fontSizes: [
                            "8",
                            "9",
                            "10",
                            "11",
                            "12",
                            "14",
                            "18",
                            "24",
                            "36",
                        ],
                        callbacks: {
                            onImageUpload: function (files) {
                                // Upload gambar ke server
                                for (let i = 0; i < files.length; i++) {
                                    uploadImage(files[i], $(this));
                                }
                            },
                        },
                    });

                    // Set dark mode jika diperlukan
                    if (document.documentElement.classList.contains("dark")) {
                        $(".note-editor").addClass("dark-mode");
                    }
                }, 200); // Sedikit delay untuk memastikan modal sudah ditampilkan
            }
        };
    }

    // Fungsi untuk upload gambar dari Summernote
    function uploadImage(file, editor) {
        if (!file || typeof $ === "undefined") return;

        const formData = new FormData();
        formData.append("file", file);

        // Tambahkan CSRF token untuk Laravel
        const csrfToken =
            document
                .querySelector('meta[name="csrf-token"]')
                ?.getAttribute("content") || "";
        formData.append("_token", csrfToken);

        $.ajax({
            url: "/upload-image", // URL endpoint untuk upload gambar
            method: "POST",
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) {
                // Insert gambar ke editor
                editor.summernote("insertImage", response.location);
            },
            error: function (xhr, status, error) {
                console.error("Error uploading image:", error);
                alert("Gagal mengunggah gambar. Silakan coba lagi.");
            },
        });
    }

    // Fungsi untuk menyembunyikan modal
    if (typeof window.hideModal === "undefined") {
        window.hideModal = function () {
            document.getElementById("articleModal").classList.add("hidden");

            // Destroy Summernote saat modal ditutup
            if (
                typeof window.summernoteInitialized === "undefined" &&
                typeof $ !== "undefined" &&
                $.fn.summernote
            ) {
                try {
                    $("#summernote").summernote("destroy");
                } catch (e) {
                    console.error("Error destroying Summernote:", e);
                }
            }

            // Reset form ketika modal ditutup
            document.querySelector("#articleModal form")?.reset();
        };
    }

    // Fungsi untuk menampilkan modal konfirmasi hapus
    if (typeof window.showDeleteModal === "undefined") {
        window.showDeleteModal = function (articleId) {
            const modal = document.getElementById("deleteArticleModal");
            const form = document.getElementById("deleteArticleForm");
            if (form && modal) {
                form.action = `/users/article/${articleId}`;
                modal.classList.remove("hidden");
            }
        };
    }

    // Fungsi untuk menyembunyikan modal konfirmasi hapus
    if (typeof window.hideDeleteModal === "undefined") {
        window.hideDeleteModal = function () {
            const modal = document.getElementById("deleteArticleModal");
            if (modal) {
                modal.classList.add("hidden");
            }
        };
    }

    // Tambahkan event listener untuk backdrop modal
    const modals = document.querySelectorAll(".fixed.inset-0.z-50");
    modals.forEach((modal) => {
        modal.addEventListener("click", function (e) {
            // Check jika yang diklik adalah backdrop (bukan konten modal)
            if (
                e.target === this.querySelector(".fixed.inset-0") ||
                e.target === this
            ) {
                hideModal();
                hideDeleteModal();
            }
        });
    });

    // Penanganan shim untuk Quill untuk mencegah error
    if (typeof window.Quill === "undefined") {
        window.Quill = {
            register: function () {},
            imports: {
                "formats/code-block": { CodeBlock: {} },
                "formats/header": {},
            },
        };
    }
});
