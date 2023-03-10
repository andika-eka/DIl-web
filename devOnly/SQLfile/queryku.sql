SELECT siswa.*, pengambilankelas.id_pengambilanKelas
FROM siswa, pengambilankelas
WHERE pengambilankelas.id_kelas = val1 AND pengambilankelas.id_siswa = siswa.id_siswa
;

SELECT subcpmkpengambilan.*
FROM subcpmkpengambilan
WHERE subcpmkpengambilan.id_pengambilanKelas = val1
;

SELECT tesformatif.*
FROM tesformatif
WHERE tesformatif.id_subCpmkPengambilan = val1
;

SELECT detailtesformatif.nomorUrut_soal, soalpilihanganda.soal, pilbenar.teks_pilihan, pilsiswa.teks_pilihan, detailtesformatif.alasanJawaban
FROM detailtesformatif, soalpilihanganda, pilihanjawaban as pilsiswa, pilihanjawaban as pilbenar
WHERE detailtesformatif.id_tesformatif = val1 AND pilsiswa.id_pilihanJawaban = detailtesformatif.id_pilihanJawaban AND soalpilihanganda.id_soalPilihanGanda = pilsiswa.id_soalPilihanGanda AND pilbenar.id_soalPilihanGanda = soalpilihanganda.id_soalPilihanGanda AND pilbenar.status_pilihan = 1
ORDER BY detailtesformatif.nomorUrut_soal
;


