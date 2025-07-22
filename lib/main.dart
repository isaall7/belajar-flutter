// ignore_for_file: prefer_const_constructors

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
      home: Scaffold(
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
              fontWeight: FontWeight.bold
            ),
          ),
        ),
      ),
    );
  }
}