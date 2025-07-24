import 'package:flutter/material.dart';
import 'package:belajar_flutter/list_view/detail_wisata.dart';

class WisataMakanan extends StatelessWidget {
  WisataMakanan({super.key});

  final List<Map<String, dynamic>> wisataData = [
    {
      "nama": "Cibadak Street Food",
      "kota": "Bandung",
      "image": "images/satu.jpg",
      "desc": "Cabadak Street food adalah tempat kuliner yang enak dan murah!",
    },
    {
      "nama": "Cibadak Street Food",
      "kota": "Bandung",
      "image": "images/dua.jpg",
      "desc": "Cabadak Street food adalah tempat kuliner yang enak dan murah!",
    },
    {
      "nama": "Cibadak Street Food",
      "kota": "Bandung",
      "image": "images/tiga.jpg",
      "desc": "Cabadak Street food adalah tempat kuliner yang enak dan murah!",
    },
    {
      "nama": "Cibadak Street Food",
      "kota": "Bandung",
      "image": "images/empat.jpg",
      "desc": "Cabadak Street food adalah tempat kuliner yang enak dan murah!",
    },
    {
      "nama": "Cibadak Street Food",
      "kota": "Bandung",
      "image": "images/lima.jpg",
      "desc": "Cabadak Street food adalah tempat kuliner yang enak dan murah!",
    },
  ];

  @override
  Widget build(BuildContext context) {
    return SafeArea(
      child: Container(
        width: double.infinity,
        height: double.infinity,
        decoration: const BoxDecoration(
          gradient: LinearGradient(
            colors: [Colors.red, Colors.green, Colors.yellow],
            begin: Alignment.topLeft,
            end: Alignment.bottomRight,
          ),
        ),
        child: ListView.builder(
          itemCount: wisataData.length,
          itemBuilder: (context, index) {
            return GestureDetector(
              onTap: () {
                Navigator.push(
                    context,
                    MaterialPageRoute(
                        builder: (context) => DetailWisataScreen(
                              nama: wisataData[index]["nama"],
                              kota: wisataData[index]["kota"],
                              image: wisataData[index]["image"],
                              desc: wisataData[index]["desc"],
                            )
                          )
                       );
              },
              child: Container(
                alignment: Alignment.bottomLeft,
                height: 200,
                margin: EdgeInsets.all(10),
                decoration: BoxDecoration(
                  image: DecorationImage(
                    image: AssetImage(wisataData[index]['image']!),
                    fit: BoxFit.cover,
                  ),
                ),
                child: Container(
                  padding: EdgeInsets.all(10),
                  decoration: BoxDecoration(
                    color: Colors.black54,
                    borderRadius: BorderRadius.circular(10),
                  ),
                  child: Text(
                    '${wisataData[index]['nama']} - ${wisataData[index]['kota']}',
                    style: TextStyle(
                      color: Colors.white,
                      fontSize: 18,
                      fontWeight: FontWeight.bold,
                    ),
                  ),
                ),
              ),
            );
          },
        ),
      ),
    );
  }
}
