import 'package:dio/dio.dart';
import '../utils/constant.dart';
import '../utils/api_wrapper.dart';
import '../models/schedule_model.dart';

class ScheduleService {
  static final Dio _dio = Dio();

  static Future<ApiResponse<YearSchedule>> getYearSchedule(int year) async {
    try {
      final response = await _dio.get(
        '${Constant.apiUrl}/schedule/year/$year',
        options: Options(headers: {'Accept': 'application/json'}),
      );

      return ApiResponse.fromJson(
        response.data,
        (data) => YearSchedule.fromJson(data as Map<String, dynamic>),
      );
    } on DioException catch (e) {
      return _handleError<YearSchedule>(e);
    }
  }

  static Future<ApiResponse<Map<String, dynamic>>> addHoliday({
    required String date,
    required String name,
  }) async {
    try {
      final response = await _dio.post(
        '${Constant.apiUrl}/schedule/holiday',
        data: {'date': date, 'name': name},
        options: Options(headers: {'Content-Type': 'application/json'}),
      );

      return ApiResponse.fromJson(
        response.data,
        (data) => data as Map<String, dynamic>,
      );
    } on DioException catch (e) {
      return _handleError<Map<String, dynamic>>(e);
    }
  }

  // SOLUSI FINAL — HANDLE ERROR DENGAN AMAN!
  static ApiResponse<T> _handleError<T>(DioException e) {
    Map<String, dynamic> errorJson = {
      'message': 'Terjadi kesalahan',
      'success': false,
      'data': null,
      'error': e.message,
    };

    if (e.response?.data != null) {
      try {
        errorJson = e.response!.data as Map<String, dynamic>;
      } catch (_) {
        // ignore
      }
    }

    return ApiResponse(
      message: errorJson['message'] ?? 'Gagal terhubung ke server',
      success: errorJson['success'] ?? false,
      data: null, // PASTI NULL — TIDAK ADA DATA
      error: errorJson['error'],
    );
  }
}