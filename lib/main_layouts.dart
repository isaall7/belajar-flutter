import 'package:flutter/material.dart';

class MainLayouts extends StatelessWidget {
  final String title;
  final Widget body;

  const MainLayouts({
    Key? key,
    required this.title,
    required this.body,
  }) : super(key: key);

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(title: Text(title)),
      body: body,
    );
  }
}
