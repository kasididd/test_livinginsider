import 'package:flutter/material.dart';
import 'package:mortgage_calculator/chart.dart';
import 'api_service.dart';

void main() {
  runApp(const MyApp());
}

class MyApp extends StatelessWidget {
  const MyApp({super.key});

  @override
  Widget build(BuildContext context) {
    return MaterialApp(
      title: 'Mortgage Dashboard',
      debugShowCheckedModeBanner: false,
      theme: ThemeData(
        primarySwatch: Colors.blue,
      ),
      home: const LoanListScreen(),
    );
  }
}

class LoanListScreen extends StatefulWidget {
  const LoanListScreen({super.key});

  @override
  _LoanListScreenState createState() => _LoanListScreenState();
}

class _LoanListScreenState extends State<LoanListScreen> {
  late Future<List<Loan>> futureLoans;

  @override
  void initState() {
    super.initState();
    futureLoans = ApiService().fetchLoans();
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: const Text('Mortgage Dashboard'),
      ),
      body: Center(
        child: SingleChildScrollView(
          child: Padding(
            padding: const EdgeInsets.all(8.0),
            child: Column(
              children: [
                FutureBuilder<List<Loan>>(
                  future: futureLoans,
                  builder: (context, snapshot) {
                    if (snapshot.hasData) {
                      List<Loan>? data = snapshot.data;
                      return ListView.builder(
                        shrinkWrap: true,
                        itemCount: data?.length,
                        itemBuilder: (context, index) {
                          return Card(
                            child: ListTile(
                              title: Text('Property Price: ${data![index].propertyPrice}'),
                              subtitle: Padding(
                                padding: const EdgeInsets.all(8.0),
                                child: Row(mainAxisAlignment: MainAxisAlignment.spaceBetween,
                                  children: [
                                    Column(
                                      crossAxisAlignment: CrossAxisAlignment.start,
                                      children: <Widget>[
                                        Text('Interest Rate: ${data[index].interestRate}%'),
                                        Text('Loan Term: ${data[index].loanTerm} years'),
                                      ],
                                    ),
                                    Column(
                                      children: [
                                                                        Text('Loan Amount: ${data[index].loanAmount}'),
                                    Text('Minimum Income: ${data[index].minimumIncome}'),
                                    Text('Monthly Payment: ${data[index].monthlyPayment}'),
                                      ],
                                    )
                                  ],
                                ),
                              ),
                            ),
                          );
                        },
                      );
                    } else if (snapshot.hasError) {
                      return Text("${snapshot.error}");
                    }
                    return const CircularProgressIndicator();
                  },
                ),
              const DashboardScreen()
              ],
            ),
          ),
        ),
      ),
    );
  }
}
