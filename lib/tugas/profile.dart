import 'package:flutter/material.dart';

class Profile extends StatelessWidget {
  Profile({super.key});

  final List<Map<String, dynamic>> profileData = [
    {
      "nama": "Ade",
      "level": "999",
      "zodiac": "Capricon",
      "foto": "images/pp.png",
      "point": "Gueh adalah sang raja desaigner",
    },
    {
      "nama": "Raphyy",
      "level": "100",
      "zodiac": "Capricon",
      "foto": "images/pp.png",
      "point": "Gueh kink A Em",
    },
  ];

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: const Text("Daftar Pemain"),
        backgroundColor: Colors.orangeAccent,
      ),
      body: Container(
        width: double.infinity,
        height: double.infinity,
        decoration: const BoxDecoration(
          gradient: LinearGradient(
            colors: [Colors.blueAccent, Colors.white],
            begin: Alignment.topLeft,
            end: Alignment.bottomRight,
          ),
        ),
        child: Column(
          crossAxisAlignment: CrossAxisAlignment.start,
          children: [
            // Text di bawah navbar
            const Padding(
              padding: EdgeInsets.all(16.0),
              child: Text(
                "List Profile",
                style: TextStyle(
                  fontSize: 22,
                  fontWeight: FontWeight.bold,
                  color: Colors.white,
                ),
              ),
            ),
            // List Profile
            Expanded(
              child: ListView.builder(
                itemCount: profileData.length,
                itemBuilder: (context, index) {
                  var data = profileData[index];
                  return Card(
                    margin: const EdgeInsets.symmetric(horizontal: 16, vertical: 8),
                    child: Padding(
                      padding: const EdgeInsets.all(12.0),
                      child: Row(
                        children: [
                          // Foto
                          ClipRRect(
                            borderRadius: BorderRadius.circular(50),
                            child: Image.asset(
                              data['foto'],
                              width: 70,
                              height: 70,
                              fit: BoxFit.cover,
                            ),
                          ),
                          const SizedBox(width: 16),
                          // Nama dan level
                          Expanded(
                            child: Column(
                              crossAxisAlignment: CrossAxisAlignment.start,
                              children: [
                                Text(
                                  data['nama'],
                                  style: const TextStyle(
                                    fontSize: 20,
                                    fontWeight: FontWeight.bold,
                                  ),
                                ),
                                const SizedBox(height: 4),
                                Text("Level: ${data['level']}"),
                              ],
                            ),
                          ),
                          // Tombol detail
                          ElevatedButton(
                            onPressed: () {
                              Navigator.push(
                                context,
                                MaterialPageRoute(
                                  builder: (context) => DetailProfile(
                                    nama: data["nama"],
                                    level: data["level"],
                                    zodiac: data["zodiac"],
                                    foto: data["foto"],
                                    point: data["point"],
                                  ),
                                ),
                              );
                            },
                            child: const Text("Detail"),
                          ),
                        ],
                      ),
                    ),
                  );
                },
              ),
            ),
          ],
        ),
      ),
    );
  }
}

class DetailProfile extends StatelessWidget {
  final String nama;
  final String level;
  final String zodiac;
  final String foto;
  final String point;

  const DetailProfile({
    super.key,
    required this.nama,
    required this.level,
    required this.zodiac,
    required this.foto,
    required this.point,
  });

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: Text("Detail Profile"),
        backgroundColor: Colors.orangeAccent,
      ),
      body: Center(
        child: Card(
          elevation: 8,
          margin: const EdgeInsets.all(24),
          shape: RoundedRectangleBorder(
            borderRadius: BorderRadius.circular(16),
          ),
          child: Padding(
            padding: const EdgeInsets.symmetric(vertical: 24, horizontal: 16),
            child: Column(
              mainAxisSize: MainAxisSize.min,
              children: [
                // Foto di tengah
                ClipRRect(
                  borderRadius: BorderRadius.circular(100),
                  child: Image.asset(
                    foto,
                    width: 120,
                    height: 120,
                    fit: BoxFit.cover,
                  ),
                ),
                const SizedBox(height: 16),
                // Nama
                Text(
                  nama,
                  style: const TextStyle(
                    fontSize: 24,
                    fontWeight: FontWeight.bold,
                  ),
                ),
                const SizedBox(height: 8),
                // Level
                Text(
                  "Level: $level",
                  style: TextStyle(fontSize: 16),
                ),
                // Zodiac
                Text(
                  "Zodiac: $zodiac",
                  style: TextStyle(fontSize: 16),
                ),
                const SizedBox(height: 12),
                // Point / Bio
                Text(
                  point,
                  textAlign: TextAlign.center,
                  style: const TextStyle(fontSize: 14, fontStyle: FontStyle.italic),
                ),
              ],
            ),
          ),
        ),
      ),
    );
  }
}
