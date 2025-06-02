-- Create rooms table
CREATE TABLE `rooms` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `room_number` varchar(10) NOT NULL,
  `type` enum('Standard','Deluxe','Suite','Executive') NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `status` enum('available','occupied') NOT NULL DEFAULT 'available',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `room_number` (`room_number`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Insert some sample data
INSERT INTO `rooms` (`room_number`, `type`, `price`, `status`) VALUES
('101', 'Standard', 100.00, 'available'),
('102', 'Standard', 100.00, 'available'),
('201', 'Deluxe', 150.00, 'available'),
('202', 'Deluxe', 150.00, 'available'),
('301', 'Suite', 250.00, 'available'),
('302', 'Suite', 250.00, 'available'),
('401', 'Executive', 350.00, 'available'),
('402', 'Executive', 350.00, 'available'); 