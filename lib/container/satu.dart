import 'package:belajar_flutter/main_layouts.dart';
import 'package:flutter/material.dart';

class ContainerSatu extends StatelessWidget {
  const ContainerSatu({super.key});

  @override
  Widget build(BuildContext context) {
    return MainLayouts( // <- Sesuaikan dengan nama class yang kamu buat
      title: 'Container Satu',
      body: Container(
        width: 300,
        height: 100,
        margin: EdgeInsets.all(10),
        color: Colors.amber, // Tambahkan warna agar kelihatan
        child: Center(
          child: Text(
            'Ini Container Satu',
            style: TextStyle(fontSize: 18),
          ),
        ),
      ),
    );
  }
}
