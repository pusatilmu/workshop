#!/bin/bash

# Menemukan direktori root repository Git secara otomatis
REPO_DIR=$(git rev-parse --show-toplevel 2>/dev/null)

# Jika tidak berada di dalam repository Git, keluar dengan pesan error
if [ -z "$REPO_DIR" ]; then
    echo "Tidak berada di dalam repository Git!"
    exit 1
fi

# Masuk ke direktori repository
cd "$REPO_DIR" || { echo "Gagal masuk ke direktori: $REPO_DIR"; exit 1; }

# Cek apakah ada perubahan di repository
if git diff-index --quiet HEAD --; then
    echo "Tidak ada perubahan yang perlu di-commit"
else
    # Variabel untuk menyimpan pesan commit
    COMMIT_MESSAGE="Perubahan: "

    # Cek perubahan pada file yang diubah (modified)
    MODIFIED_FILES=$(git diff --name-only --diff-filter=M)
    if [ -n "$MODIFIED_FILES" ]; then
        COMMIT_MESSAGE+="Mengubah file: $MODIFIED_FILES. "
    fi

    # Cek perubahan pada file yang ditambahkan (added)
    ADDED_FILES=$(git diff --name-only --diff-filter=A)
    if [ -n "$ADDED_FILES" ]; then
        COMMIT_MESSAGE+="Menambahkan file: $ADDED_FILES. "
    fi

    # Cek perubahan pada file yang dihapus (deleted)
    DELETED_FILES=$(git diff --name-only --diff-filter=D)
    if [ -n "$DELETED_FILES" ]; then
        COMMIT_MESSAGE+="Menghapus file: $DELETED_FILES. "
    fi

    # Menambahkan semua perubahan ke staging area
    git add .

    # Menggunakan pesan commit yang telah dibuat
    git commit -m "$COMMIT_MESSAGE"

    # Push commit ke remote repository
    git push origin main

    echo "Perubahan telah di-commit dan dipush ke repository dengan pesan: $COMMIT_MESSAGE"
fi
