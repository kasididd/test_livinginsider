import 'package:flutter/material.dart';
import 'package:syncfusion_flutter_charts/charts.dart';
import 'api_service.dart'; // อย่าลืมสร้างไฟล์นี้ตามตัวอย่างก่อนหน้า

class DashboardScreen extends StatefulWidget {
  const DashboardScreen({super.key});

  @override
  _DashboardScreenState createState() => _DashboardScreenState();
}

class _DashboardScreenState extends State<DashboardScreen> {
  late Future<List<Loan>> futureLoans;

  @override
  void initState() {
    super.initState();
    futureLoans = ApiService().fetchLoans();
  }

  @override
  Widget build(BuildContext context) {
    return FutureBuilder<List<Loan>>(
      future: futureLoans,
      builder: (context, snapshot) {
        if (snapshot.connectionState == ConnectionState.waiting) {
          return const Center(child: Padding(
            padding: EdgeInsets.only(top:200.0),
            child: CircularProgressIndicator(),
          ));
        } else if (snapshot.hasError) {
          return Center(child: Text('Error: ${snapshot.error}'));
        } else if (!snapshot.hasData || snapshot.data!.isEmpty) {
          return const Center(child: Text('No data available'));
        } else {
          final loans = snapshot.data!;
          final chartData = loans.map((loan) => ChartData(loan.propertyPrice.toString(), loan.loanAmount)).toList();
          final pieData = loans.map((loan) => ChartData(loan.propertyPrice.toString(), loan.minimumIncome)).toList();

          return Column(
            children: [
              SizedBox(
                height: 300,
                child: SfCartesianChart(
                  title: const ChartTitle(text: 'Monthly Sales Data'),
                  legend: const Legend(isVisible: true),
                  primaryXAxis: const CategoryAxis(),
                  series: [
                    ColumnSeries<ChartData, String>(
                      dataSource: chartData,
                      xValueMapper: (ChartData data, _) => data.x,
                      yValueMapper: (ChartData data, _) => data.y,
                      name: 'Sales',
                      dataLabelSettings: const DataLabelSettings(isVisible: true),
                    )
                  ],
                ),
              ),
              SizedBox(
                height: 300,
                child: SfCartesianChart(
                  title: const ChartTitle(text: 'Sales Trend'),
                  legend: const Legend(isVisible: true),
                  primaryXAxis: const CategoryAxis(),
                  series: [
                    LineSeries<ChartData, String>(
                      dataSource: chartData,
                      xValueMapper: (ChartData data, _) => data.x,
                      yValueMapper: (ChartData data, _) => data.y,
                      name: 'Sales',
                      dataLabelSettings: const DataLabelSettings(isVisible: true),
                    )
                  ],
                ),
              ),
              SizedBox(
                height: 300,
                child: SfCircularChart(
                  title: const ChartTitle(text: 'Product Sales Distribution'),
                  legend: const Legend(isVisible: true),
                  series: <CircularSeries>[
                    PieSeries<ChartData, String>(
                      dataSource: pieData,
                      xValueMapper: (ChartData data, _) => data.x,
                      yValueMapper: (ChartData data, _) => data.y,
                      dataLabelSettings: const DataLabelSettings(isVisible: true),
                    )
                  ],
                ),
              ),
            ],
          );
        }
      },
    );
  }
}

class ChartData {
  ChartData(this.x, this.y);
  final String x;
  final double y;
}
