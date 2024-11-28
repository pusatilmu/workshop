#!/bin/bash

# Memastikan ada argumen cabang yang diberikan
if [ -z "$1" ]; then
  echo "Harap masukkan nama cabang yang ingin dibuat."
  exit 1
fi

# Menyimpan nama cabang dalam variabel
BRANCH_NAME=$1

# Membuat dan beralih ke cabang baru
git checkout -b "$BRANCH_NAME"

# Mengecek apakah perintah checkout berhasil
if [ $? -eq 0 ]; then
  echo "Cabang '$BRANCH_NAME' berhasil dibuat dan beralih ke cabang tersebut."
else
  echo "Terjadi kesalahan saat membuat cabang '$BRANCH_NAME'."
  exit 1
fi

# Menanyakan apakah ingin mempush cabang ke remote
read -p "Apakah Anda ingin mempush cabang '$BRANCH_NAME' ke remote (origin)? (y/n): " PUSH_TO_REMOTE

if [[ "$PUSH_TO_REMOTE" =~ ^[Yy]$ ]]; then
  git push -u origin "$BRANCH_NAME"
  if [ $? -eq 0 ]; then
    echo "Cabang '$BRANCH_NAME' berhasil dipush ke remote."
  else
    echo "Terjadi kesalahan saat mempush cabang ke remote."
    exit 1
  fi
else
  echo "Cabang '$BRANCH_NAME' tidak dipush ke remote."
fi

# Agar terminal tidak langsung tertutup
read -p "Proses selesai. Tekan [Enter] untuk keluar..."
