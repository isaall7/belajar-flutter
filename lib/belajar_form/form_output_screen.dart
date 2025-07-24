import 'package:belajar_flutter/belajar_form/form_screen.dart';
import 'package:belajar_flutter/helpers/size_helper.dart';
import 'package:belajar_flutter/belajar_form/form_output_screen.dart';
import 'package:flutter/material.dart';
import 'package:intl/intl.dart';

class BelajarForm extends StatefulWidget {
  const BelajarForm({super.key});

  @override
  State<BelajarForm> createState() => _BelajarFormState();
}

class _BelajarFormState extends State<BelajarForm> {
  final _formKey = GlobalKey<FormState>();

  TextEditingController namaController = TextEditingController();
  TextEditingController jkController = TextEditingController();
  TextEditingController tglLahirController = TextEditingController();
  String _pilihAgama = "";

  final List<String> agama = [
    "Islam",
    "Protestan",
    "Katholik",
    "Budha",
    "Atheis"
  ];

  @override
  void initState() {
    tglLahirController.text = '';
    super.initState();
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: const Text("Form Biodata"),
        centerTitle: true,
        backgroundColor: Colors.blue[500],
      ),
      body: SafeArea(
        child: SingleChildScrollView(
          padding: const EdgeInsets.all(16),
          child: Center(
            child: Card(
              elevation: 8,
              shape: RoundedRectangleBorder(
                borderRadius: BorderRadius.circular(16),
              ),
              child: Padding(
                padding: const EdgeInsets.all(24),
                child: Form(
                  key: _formKey,
                  child: Column(
                    children: [
                      Text(
                        "Formulir Biodata",
                        style: TextStyle(
                          fontWeight: FontWeight.bold,
                          fontSize: 20,
                          color: Colors.blue[900],
                        ),
                      ),
                      const SizedBox(height: 24),

                      // Nama
                      TextFormField(
                        controller: namaController,
                        decoration: InputDecoration(
                          labelText: "Nama Lengkap",
                          prefixIcon: Icon(Icons.person),
                          border: OutlineInputBorder(),
                        ),
                        validator: (value) =>
                            value!.isEmpty ? 'Input Nama' : null,
                      ),
                      const SizedBox(height: 18),

                      // Jenis Kelamin
                      TextFormField(
                        controller: jkController,
                        decoration: InputDecoration(
                          labelText: "Jenis Kelamin",
                          prefixIcon: Icon(Icons.transgender),
                          border: OutlineInputBorder(),
                        ),
                        validator: (value) =>
                            value!.isEmpty ? 'Input Jenis Kelamin' : null,
                      ),
                      const SizedBox(height: 18),

                      // Tanggal Lahir
                      TextFormField(
                        controller: tglLahirController,
                        readOnly: true,
                        decoration: InputDecoration(
                          labelText: "Tanggal Lahir",
                          prefixIcon: Icon(Icons.calendar_today),
                          border: OutlineInputBorder(),
                        ),
                        validator: (value) =>
                            value!.isEmpty ? 'Input Tanggal Lahir' : null,
                        onTap: () async {
                          DateTime? pickedDate = await showDatePicker(
                            context: context,
                            initialDate: DateTime.now(),
                            firstDate: DateTime(1900),
                            lastDate: DateTime(2100),
                          );
                          if (pickedDate != null) {
                            String tgl = DateFormat('yyyy-MM-dd').format(pickedDate);
                            setState(() {
                              tglLahirController.text = tgl;
                            });
                          }
                        },
                      ),
                      const SizedBox(height: 18),

                      // Dropdown Agama
                      DropdownButtonFormField<String>(
                        decoration: InputDecoration(
                          labelText: "Pilih Agama",
                          border: OutlineInputBorder(),
                          prefixIcon: Icon(Icons.star),
                        ),
                        value: _pilihAgama.isNotEmpty ? _pilihAgama : null,
                        items: agama.map((String item) {
                          return DropdownMenuItem<String>(
                            value: item,
                            child: Text(item),
                          );
                        }).toList(),
                        onChanged: (String? newValue) {
                          setState(() {
                            _pilihAgama = newValue!;
                          });
                        },
                        validator: (value) =>
                            value == null || value.isEmpty ? 'Pilih Agama' : null,
                      ),
                      const SizedBox(height: 24),

                      // Tombol Simpan
                      SizedBox(
                        width: displayWidth(context) * 0.8,
                        height: displayHeight(context) * 0.075,
                        child: ElevatedButton(
                          style: ElevatedButton.styleFrom(
                            backgroundColor: Colors.blueGrey,
                            shape: RoundedRectangleBorder(
                              borderRadius: BorderRadius.circular(24),
                              side: const BorderSide(color: Colors.black),
                            ),
                          ),
                          child: const Text(
                            "Simpan",
                            style: TextStyle(color: Colors.white, fontSize: 16),
                          ),
                          onPressed: () => _submit(),
                        ),
                      ),
                    ],
                  ),
                ),
              ),
            ),
          ),
        ),
      ),
    );
  }

  void _submit() {
    final isValid = _formKey.currentState!.validate();
    if (!isValid) return;

    String nama = namaController.text;
    String jk = jkController.text;
    String agama = _pilihAgama;
    String tglLahir = tglLahirController.text;

    Navigator.push(
      context,
      MaterialPageRoute(
        builder: (context) => OutputFormScreen(
          nama: nama,
          jk: jk,
          tglLahir: tglLahir,
          agama: agama,
        ),
      ),
    );
  }
}
