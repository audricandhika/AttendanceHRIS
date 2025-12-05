import 'package:flutter/material.dart';
import 'screens/attendance_screen.dart';
import 'screens/home_screen.dart';
import 'screens/schedule_screen.dart';

final Map<String, WidgetBuilder> appRoutes = {
  '/home': (context) => const HomeScreen(),
  '/attendance': (context) => const AttendanceScreen(),
  '/schedule': (context) => const ScheduleScreen(),
};