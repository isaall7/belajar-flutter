import 'package:belajar_flutter/main_layouts.dart';
import 'package:flutter/material.dart';

class RowSatu extends StatelessWidget {
  const RowSatu({super.key});

  @override
  Widget build(BuildContext context) {
    return MainLayouts(
      title: 'colomn satu',
      body: Column(
        mainAxisAlignment: MainAxisAlignment.start,
        children: [
          Text('widget text 1'),
          Text('widget text 2'),
          Text('widget text 3'),
          Row(
            mainAxisAlignment: MainAxisAlignment.center,
            children: [
              Text('text 1'),
              Text('text 2'),
              Text('text 3'),
            ],
          )
        ],
      ),
    );
  }
}
