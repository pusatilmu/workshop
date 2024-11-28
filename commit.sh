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
    # Cek perubahan pada file yang diubah (modified)
    MODIFIED_FILES=$(git diff --name-only --diff-filter=M)
    if [ -n "$MODIFIED_FILES" ]; then
        for FILE in $MODIFIED_FILES; do
            git add "$FILE"
            git commit -m "Mengubah file: $FILE"
            echo "File '$FILE' telah di-commit."
        done
    fi

    # Cek perubahan pada file yang ditambahkan (added)
    ADDED_FILES=$(git diff --name-only --diff-filter=A)
    if [ -n "$ADDED_FILES" ]; then
        for FILE in $ADDED_FILES; do
            git add "$FILE"
            git commit -m "Menambahkan file: $FILE"
            echo "File '$FILE' telah di-commit."
        done
    fi

    # Cek perubahan pada file yang dihapus (deleted)
    DELETED_FILES=$(git diff --name-only --diff-filter=D)
    if [ -n "$DELETED_FILES" ]; then
        for FILE in $DELETED_FILES; do
            git add "$FILE"
            git commit -m "Menghapus file: $FILE"
            echo "File '$FILE' telah di-commit."
        done
    fi

    # Push commit ke remote repository setelah semua commit selesai
    git push origin main

    echo "Semua perubahan telah di-commit dan dipush ke repository."
fi

# Menunggu input pengguna sebelum menutup terminal
echo "Tekan Enter untuk keluar..."
read
