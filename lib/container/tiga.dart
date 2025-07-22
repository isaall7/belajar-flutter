import 'package:belajar_flutter/main_layouts.dart';
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
      home: ContainerTiga(),
    );
  }
}

class ContainerDua extends StatelessWidget {
  const ContainerDua({super.key});

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: Text('Container Dua'),
        backgroundColor: Colors.amberAccent,
      ),
      body: Center(
        child: Text(
          'Ini Halaman Container Dua',
          style: TextStyle(fontSize: 20),
        ),
      ),
    );
  }
}

class ContainerTiga extends StatelessWidget {
  const ContainerTiga({super.key});

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: Text('Container Tiga'),
        backgroundColor: Colors.deepPurple,
      ),
      body: Center(
        child: Container(
          padding: EdgeInsets.all(20),
          color: Colors.redAccent, // Container luar
          child: Container(
            padding: EdgeInsets.all(20),
            color: Colors.greenAccent, // Container tengah
            child: Container(
              padding: EdgeInsets.all(20),
              color: Colors.blueAccent, // Container dalam
              child: Center(
                child: ElevatedButton(
                  onPressed: () {
                    Navigator.push(
                      context,
                      MaterialPageRoute(builder: (context) => ContainerDua()),
                    );
                  },
                  child: Text('Kembali ke Container Dua'),
                ),
              ),
            ),
          ),
        ),
      ),
    );
  }
}
