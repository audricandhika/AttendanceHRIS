import 'package:dio/dio.dart';
import '../utils/constant.dart';
import '../utils/api_wrapper.dart';
import '../models/attendance_model.dart';
import 'location_service.dart';

class AttendanceService {
  static final Dio _dio = Dio();
  static const int employeeId = Constant.testEmployeeId;

  // GET STATUS
  static Future<ApiResponse<AttendanceStatus>> getStatus() async {
    try {
      final response = await _dio.get(
        '${Constant.apiUrl}/absen/status',
        options: Options(headers: {'X-Test-Employee-Id': employeeId}),
      );
      return ApiResponse.fromJson(
        response.data,
        (data) => AttendanceStatus.fromJson(data as Map<String, dynamic>),
      );
    } on DioException catch (e) {
      return _handleError(e);
    }
  }

  // CLOCK IN / OUT / LEMBUR IN / OUT
  static Future<ApiResponse<Map<String, dynamic>>> clockIn() => _action('absen/in');
  static Future<ApiResponse<Map<String, dynamic>>> clockOut() => _action('absen/out');
  static Future<ApiResponse<Map<String, dynamic>>> lemburIn() => _action('lembur/in');
  static Future<ApiResponse<Map<String, dynamic>>> lemburOut() => _action('lembur/out');

  static Future<ApiResponse<Map<String, dynamic>>> _action(String endpoint) async {
    final position = await LocationService.getCurrent();
    if (position == null) {
      return ApiResponse(
        message: 'Izin lokasi ditolak!',
        success: false,
        data: null,
        error: null,
      );
    }

    try {
      final response = await _dio.post(
        '${Constant.apiUrl}/$endpoint',
        data: {
          'latitude': position.latitude,
          'longitude': position.longitude,
        },
        options: Options(headers: {'X-Test-Employee-Id': employeeId}),
      );

      return ApiResponse.fromJson(
        response.data,
        (data) => data as Map<String, dynamic>,
      );
    } on DioException catch (e) {
      return _handleActionError(e);
    }
  }

  static ApiResponse<Map<String, dynamic>> _handleActionError(DioException e) {
    if (e.response?.data != null) {
      final json = e.response!.data as Map<String, dynamic>;
      return ApiResponse.fromJson(
        json,
        (data) => data as Map<String, dynamic>,
      );
    }
    return ApiResponse(
      message: 'Tidak ada koneksi internet',
      success: false,
      data: null,
      error: e.message,
    );
  }

  static ApiResponse<AttendanceStatus> _handleError(DioException e) {
    if (e.response?.data != null) {
      final json = e.response!.data as Map<String, dynamic>;
      return ApiResponse.fromJson(
        json,
        (data) => AttendanceStatus.fromJson({}),
      );
    }
    return ApiResponse(
      message: 'Tidak ada koneksi internet',
      success: false,
      data: null,
      error: e.message,
    );
  }
}