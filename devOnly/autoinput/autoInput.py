import csv
from http.client import responses
import requests
import json
import pprint

pp = pprint.PrettyPrinter(width=41, compact=True)

def parse_student(file_path):
    with open(file_path, 'r') as file:
        csv_reader = csv.reader(file, delimiter=',')
        data = list()
        for row in csv_reader:
            student = {
                "nim" : row[1],
                "name" : row[2],
                'email' : row[3],
            }
            data.append(student);
        return data

def parse_subcpmk(file_path):
    with open(file_path, 'r') as file:
        csv_reader = csv.reader(file, delimiter=',')
        data = list()
        for row in csv_reader:
            data.append(row);
        return data

def parse_indikator(file_path):
    with open(file_path, 'r') as file:
        csv_reader = csv.reader(file, delimiter=',')
        data = list()
        for row in csv_reader:
            indikator = {
                "subcpmk" : row[0],
                "narasi" : row[1],
                "level" : row[2],
            }
            data.append(indikator);
        return data

def parse_soal(file_path):
    with open(file_path, 'r', encoding='utf-8') as file:
        csv_reader = csv.reader(file, delimiter='\t', )
        data = list()
        for row in csv_reader:
            soal = {
                "soal" : row[0],
                "pilihan" : [row[1],row[2],row[3],row[4]],
                "kunci" : row[5],
                "gambar": row[6],
                'indikator': row[7]
            }
            data.append(soal);
        return data
def register_student(student, url_register, token, url_assign):

    hed = {'Authorization': 'Bearer ' + token}

    for s in student:
        data = {'name' : s['name'],
                'email' : s['email'],
                'password' : s['nim'],
                'tipe_pengguna' : 3,
                'status_pengguna' : 1,
                }
        # pp.pprint(data)
        response = requests.post(url_register, json=data, headers=hed)
        print(response)
        # pp.pprint(response.json())
        json_data = response.json()

        id = json_data['id']

        data2 ={'id_siswa' :id,
                'status_pengambilanKelas':1
                }
        response = requests.post(url_assign, json=data2, headers=hed)
        print(response)
        # pp.pprint(response.json())

def import_content(url, data, file_path, token):
    hed = {'Authorization': 'Bearer ' + token}

    for no_subcpmk,subcpmk in enumerate(data["subcpmk"]):
        subcmpk_form ={
            'nomorUrut_subCpmk' : no_subcpmk+1,
            'narasi_subCpmk' : subcpmk,
            'taksnomi_bloom' :1
        }
        subcpmk_file = {
            'materiTeks' :  open(file_path['subcpmk']+'/'+str(no_subcpmk+1)+'.pdf', 'rb')
        }
        response = requests.post(url['subcpmk'], files=subcpmk_file, data=subcmpk_form, headers=hed)
        print(response)
        # pp.pprint(response.json())

        json_data = response.json()
        subcpmk_id =json_data['subcpmk']['id_subCpmk']
        count_indikator = 1
        for no_indikator, indikator in enumerate(data['indikator']):

            if int(indikator['subcpmk']) < no_subcpmk+1:
                continue
            if int(indikator['subcpmk']) > no_subcpmk+1:
                break

            indikator_form = {
                'nomorUrut_indikator': count_indikator,
                'narasi_indikator' : indikator["narasi"],
                'pertemuanKe' : no_indikator+1,
                'level_indikator' :indikator['level']
            }
            count_indikator += 1

            indikator_url = url['indikator'].replace('{{subcpmk_id}}',str(subcpmk_id))

            response = requests.post(indikator_url, data=indikator_form, headers=hed)
            print(response)
            # pp.pprint(response.json())
            json_data = response.json()
            indikator_id =json_data['indikator']['id_indikator']

            for no_soal, soal in enumerate(data['soal']):
                if int(soal['indikator']) < no_indikator+1:
                    continue
                if int(soal['indikator']) > no_indikator+1:
                    break

                soal_form = {
                    'soal' : soal['soal'],
                }

                soal_url = url['soal'].replace('{{indikator_id}}',str(indikator_id))

                if int(soal['gambar']):
                    soal_pic = {
                        'gambar' :  open(file_path['soal']+'/'+str(no_soal+1)+'.png', 'rb')
                    }
                    response = requests.post(soal_url, data=soal_form, files=soal_pic, headers=hed)

                else:
                    response = requests.post(soal_url, data=soal_form, headers=hed)
                print(response)
                json_data = response.json()
                soal_id =json_data['soal']['id_soalPilihanGanda']

                for no_pilihan, pilihan in enumerate(soal['pilihan']):
                    status = 0
                    if no_pilihan+1 == int(soal['kunci']):
                        status = 1

                    jawaban_form = {
                        'noUrut_pilihan' : no_pilihan+1,
                        'teks_pilihan' : pilihan,
                        'status_pilihan' : status,
                    }
                    jawaban_url = url['jawaban'].replace('{{soal_id}}',str(soal_id))
                    response = requests.post(jawaban_url, data=jawaban_form, headers=hed)
                    print(response)

if __name__ == '__main__':

<<<<<<< HEAD
    id_kelas = '63'
    id_matkul = '21'
    token_dosen = 'MgMeouaOq1YpQRoBM6YswzV8BZ6ZIllzLfeeFAhBsnOoClBhFBrVj4RLYzxR'
    token_admin = 'zDLzifdEVbQF4FKHNXaBV4Z0nyGeHK0zvUBe0DNMrqccefpuIVBbd0RiHkX1'
=======
    id_kelas = '1'
    id_matkul = '1'
    token_dosen = 'FmSrNTHSnhitVq1GT5QDCzeYMlfo58uIebw9B066u9OF3v1aP09RXirT4F5N'
    token_admin = 'HUIz5WgpypjEHdCIvfguVjzAIpdez3U5UFhqgjzacDxFna8H8EEvLrDt3D0q'
>>>>>>> e91986f0f2677dd1c78577eb84e9f30cdb7c4a45
    url = {
        'subcpmk' : 'http://127.0.0.1:8000/api/Matakuliah/'+id_matkul+'/subcpmk',
        'indikator' : 'http://127.0.0.1:8000/api/subcpmk/{{subcpmk_id}}/indikator',
        # 'materi' : '',
        'soal' : 'http://127.0.0.1:8000/api/indikator/{{indikator_id}}/soal',
        'jawaban' :'http://127.0.0.1:8000/api/soal/{{soal_id}}/jawaban',
        'register' :'http://127.0.0.1:8000/api/register',
        'add_to_kelas' :'http://127.0.0.1:8000/api/Kelas/'+id_kelas+'/addsiswa',
    }
    path ={
        'subcpmk' : './subcpmk',
        'soal' : './soal'
    }


    student = parse_student('./student.csv')
    subcpmk = parse_subcpmk('./subcpmk.csv')
    indikator = parse_indikator('./indikator.csv')
    soal = parse_soal('./soal.tsv')

    data = {
        'subcpmk' : subcpmk,
        'indikator' : indikator,
        # 'materi' : '',
        'soal' : soal,
    }

    register_student(student, url['register'] ,token_admin, url['add_to_kelas'] )
    import_content(url, data, path, token_dosen)
