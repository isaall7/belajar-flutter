import 'package:belajar_flutter/main_layouts.dart';
import 'package:flutter/material.dart';

class ContohTiga extends StatelessWidget {
  ContohTiga({super.key});

  final List<Color> colorList = [Colors.red, Colors.green, Colors.blue];
  final List<String> partaiList = [
    'Partai Banteng',
    'Partai Kabah',
    'Partai Joged',
  ];
  @override
  Widget build(BuildContext context) {
    return MainLayouts(
      title: 'Contoh List View Builder',
      body: SizedBox(
        width: double.infinity,
        height: 200,
        child: ListView.builder(
          scrollDirection: Axis.horizontal,
          itemCount: colorList.length,
          itemBuilder: (context, index) {
            return Container(
              margin: EdgeInsets.all(10),
              width: 200,
              height: 300,
              color: colorList[index],
              child: Center(child: Text(partaiList[index])),
            );
          },
        ),
      ),
    );
  }
}
