import 'package:belajar_flutter/main_layouts.dart';
import 'package:flutter/material.dart';

class LatihanRowColom extends StatelessWidget {
  const LatihanRowColom({super.key});

  @override
  Widget build(BuildContext context) {
    return MainLayouts(
        title: 'Latihan Row Colom',
        body: Center(
          child: Container(
            height: 80,
            width: double.infinity,
            color: Colors.blueGrey,
            child: Row(
              mainAxisAlignment: MainAxisAlignment.spaceEvenly,
              children: [
                Column(
                  mainAxisAlignment: MainAxisAlignment.spaceEvenly,
                  children: [Icon(Icons.call), Text('call')],
                ),
                Column(
                  mainAxisAlignment: MainAxisAlignment.spaceEvenly,
                  children: [Icon(Icons.route), Text('Route')],
                ),
                Column(
                  mainAxisAlignment: MainAxisAlignment.spaceEvenly,
                  children: [Icon(Icons.share), Text('Share')],
                ),
              ],
            ),
          ),
        ));
  }
}
