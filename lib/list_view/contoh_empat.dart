import 'package:belajar_flutter/main_layouts.dart';
import 'package:flutter/material.dart';

class ListItem {
  final Color color;
  final String text;

  ListItem(this.color, this.text);
}

class ContohEmpat extends StatelessWidget {
  ContohEmpat({super.key});

  final List<ListItem> itemlist = [
    ListItem(Colors.red, 'Partai Banteng'),
    ListItem(Colors.green, 'Partai Kabah'),
    ListItem(Colors.blue, 'Partai Joged'),
  ];

  @override
  Widget build(BuildContext context) {
    return MainLayouts(
      title: 'List separated',
      body: SizedBox(
        child: ListView.separated(
          separatorBuilder: (context, index) {
            return const Divider(color: Colors.black);
          },
          itemBuilder: (context, index) {
            return Container(
              margin: const EdgeInsets.all(10),
              width: 200,
              height: 300,
              color: itemlist[index].color,
              child: Center(
                child: Text(
                  itemlist[index].text,
                  style: const TextStyle(fontSize: 18, color: Colors.white),
                ),
              ),
            );
          },
          itemCount: itemlist.length,
        ),
      ),
    );
  }
}