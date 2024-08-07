import 'dart:convert';
import 'package:http/http.dart' as http;
import 'package:mortgage_calculator/config.dart';

class ApiService {
  static const String baseUrl = 'https://$server/backend/get_loan.php';

  Future<List<Loan>> fetchLoans() async {
    final response = await http.get(Uri.parse(baseUrl));

    if (response.statusCode == 200) {
      List jsonResponse = json.decode(response.body);
      return jsonResponse.map((data) => Loan.fromJson(data)).toList();
    } else {
      throw Exception('Failed to load loans');
    }
  }
}

class Loan {
  final int id;
  final double propertyPrice;
  final double interestRate;
  final int loanTerm;
  final double loanAmount;
  final double minimumIncome;
  final double monthlyPayment;

  Loan({
    required this.id,
    required this.propertyPrice,
    required this.interestRate,
    required this.loanTerm,
    required this.loanAmount,
    required this.minimumIncome,
    required this.monthlyPayment,
  });

  factory Loan.fromJson(Map<String, dynamic> json) {
    return Loan(
      id: int.parse(json['id']),
      propertyPrice: double.parse(json['property_price']),
      interestRate:  double.parse(json['interest_rate']),
      loanTerm: int.parse(json['loan_term']),
      loanAmount:  double.parse(json['loan_amount']),
      minimumIncome:  double.parse(json['minimum_income']),
      monthlyPayment:  double.parse(json['monthly_payment']),
    );
  }
}
