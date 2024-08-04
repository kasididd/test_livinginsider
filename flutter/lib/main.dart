import 'package:flutter/material.dart';
import 'package:flutter/services.dart';
import 'package:flutter_svg/flutter_svg.dart';
// import 'package:google_fonts/google_fonts.dart';

void main() {
  runApp(const MyApp());
}

class MyApp extends StatelessWidget {
  const MyApp({super.key});

  @override
  Widget build(BuildContext context) {
    return MaterialApp(
      title: 'Estimated Mortgage Calculator',
    theme: ThemeData(
      primarySwatch: Colors.pink,
      // textTheme: GoogleFonts.sarabunTextTheme(),
    ),
      home: const MortgageCalculator(),
    );
  }
}

class MortgageCalculator extends StatefulWidget {
  const MortgageCalculator({super.key});

  @override
  _MortgageCalculatorState createState() => _MortgageCalculatorState();
}

class _MortgageCalculatorState extends State<MortgageCalculator> {
  final _propertyPriceController = TextEditingController();
  final _interestRateController = TextEditingController();
  final _loanTermController = TextEditingController();

  double _loanAmount = 0;
  double _minimumIncome = 0;
  double _monthlyPayment = 0;

  @override
  void dispose() {
    _propertyPriceController.dispose();
    _interestRateController.dispose();
    _loanTermController.dispose();
    super.dispose();
  }

  void _calculateLoan() {
    final propertyPrice = double.tryParse(_propertyPriceController.text.replaceAll(',', '')) ?? 0;
    final interestRate = double.tryParse(_interestRateController.text) ?? 0;
    final loanTerm = double.tryParse(_loanTermController.text) ?? 0;

    if (propertyPrice > 0 && interestRate > 0 && loanTerm > 0) {
      setState(() {
        _loanAmount = propertyPrice;
        _minimumIncome = (propertyPrice / 650000) * 10000;
        final monthlyInterestRate = interestRate / 100 / 12;
        final numberOfPayments = loanTerm * 12;
        _monthlyPayment = (propertyPrice * monthlyInterestRate) / (1 - (1 / (1 + monthlyInterestRate) * (numberOfPayments)));
      });
    }
  }

  void _resetFields() {
    _propertyPriceController.clear();
    _interestRateController.clear();
    _loanTermController.clear();
    setState(() {
      _loanAmount = 0;
      _minimumIncome = 0;
      _monthlyPayment = 0;
    });
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: const Text('Estimated Mortgage Calculator'),
      ),
      body: Padding(
        padding: const EdgeInsets.all(16.0),
        child: Column(
          children: [
            TextField(
              controller: _propertyPriceController,
              decoration: const InputDecoration(
                labelText: 'ราคาอสังหาฯ',
                border: OutlineInputBorder(),
              ),
              keyboardType: TextInputType.number,
              inputFormatters: [FilteringTextInputFormatter.digitsOnly],
              onChanged: (_) => _calculateLoan(),
            ),
            const SizedBox(height: 16),
            Row(
              children: [
                Expanded(
                  child: TextField(
                    controller: _interestRateController,
                    decoration: const InputDecoration(
                      labelText: 'อัตราดอกเบี้ย',
                      border: OutlineInputBorder(),
                    ),
                    keyboardType: TextInputType.number,
                    inputFormatters: [FilteringTextInputFormatter.digitsOnly],
                    onChanged: (_) => _calculateLoan(),
                  ),
                ),
                const SizedBox(width: 16),
                Expanded(
                  child: TextField(
                    controller: _loanTermController,
                    decoration: const InputDecoration(
                      labelText: 'จำนวนปี',
                      border: OutlineInputBorder(),
                    ),
                    keyboardType: TextInputType.number,
                    inputFormatters: [FilteringTextInputFormatter.digitsOnly],
                    onChanged: (_) => _calculateLoan(),
                  ),
                ),
              ],
            ),
            const SizedBox(height: 16),
            Row(
              mainAxisAlignment: MainAxisAlignment.spaceBetween,
              children: [
                ElevatedButton.icon(
                  onPressed: _resetFields,
                  icon: SvgPicture.asset('assets/icon_retry-arrow.svg'),
                  label: const Text('ล้างข้อมูล'),
                ),
                ElevatedButton(
                  onPressed: _calculateLoan,
                  child: const Text('คำนวณสินเชื่อ'),
                ),
              ],
            ),
            const SizedBox(height: 16),
            Card(
              child: Padding(
                padding: const EdgeInsets.all(16.0),
                child: Column(
                  crossAxisAlignment: CrossAxisAlignment.start,
                  children: [
                    const Text('ผลคำนวณเงินกู้ (กรณีกู้ได้ 100%)'),
                    const SizedBox(height: 8),
                    _buildResultRow('วงเงินกู้', _loanAmount),
                    _buildResultRow('รายได้ขั้นต่ำต่อเดือน', _minimumIncome),
                    _buildResultRow('ยอดผ่อนต่อเดือน', _monthlyPayment),
                  ],
                ),
              ),
            ),
          ],
        ),
      ),
    );
  }

  Widget _buildResultRow(String label, double value) {
    return Row(
      mainAxisAlignment: MainAxisAlignment.spaceBetween,
      children: [
        Text(label),
        Text(value.toStringAsFixed(2)),
      ],
    );
  }
}
