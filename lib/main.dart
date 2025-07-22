import 'package:belajar_flutter/container/dua.dart';
import 'package:belajar_flutter/container/satu.dart';
import 'package:belajar_flutter/container/tiga.dart';
import 'package:belajar_flutter/row_colom/row_colomn.dart';
import 'package:belajar_flutter/row_colom/row_satu.dart';
import 'package:belajar_flutter/row_colom/latihan_row_colom.dart';
import 'package:flutter/material.dart';

void main() {
  runApp(BelajarFlutter());
}

class BelajarFlutter extends StatelessWidget {
  const BelajarFlutter({super.key});

  @override
  Widget build(BuildContext context) {
    return MaterialApp(
      debugShowCheckedModeBanner: false,
      home: LatihanRowCol(),
    );
  }
}

class HelloFlutter extends StatelessWidget {
  const HelloFlutter({
    super.key,
  });

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        centerTitle: true,
        backgroundColor: Colors.amberAccent,
        title: Text('Belajar Flutter'),
      ),
      body: Center(
        child: Text('Hello Flutter', 
          style: TextStyle(
            backgroundColor: Colors.blueAccent, 
            fontSize: 24, 
            fontWeight: FontWeight. bold
          ),
        ),
      ),
    );
  }
}