# Hotel-Reservation-System
A Website for an Hotel Reservation System

The database has 7 entities: Hotel, Guest, Rooms, RoomType, Reservation, admin and blacklist.
1.	Hotel: id, Name, Approved, activation_start_date, password, stars, Image, Location, rate, premium, amount_owned, suspended.
2.	Guest: id, Name, Address, birthdate, Phone, black_list_start_date, blacklisted, rate.
3.	RoomType: type_id, type_name
4.	Reservation: number, start_date, RoomType, end_date, checked_in
5.	Rooms: roomiD, no_of_rooms, facilities, price, image
6.	admin: username, password.
7.	blacklist: id, startDate.

Features:
•	Hotel gets suspended by admin.
•	Hotel gets approved by admin.
•	Hotel has Rooms.
•	Hotel can rate Guest.
•	Rooms contain Reservation.
•	Rooms have RoomType
•	Guest books Reservation
•	Guest can be marked blacklisted


Types of Users:
Owner:
•	Add hotel(hotel address, password, hotel image)
•	Edit existing hotel (edit rooms, reservation, hotel details, edit rooms (their number and type))
•	Cancel Reservation within 30 seconds from reserving.
Broker:
•	Broker sign in and password insert into admin database.
•	Broker will appear pending Hotels where approved =0 when we click approve it will change Hotel to active hotels.
•	The broker suspends hotels in case of nonpayment for instance it does not appear in search.
•	The broker reactivates a suspended hotel when it pays its dues.

The database checks if the entered hotel already exists to avoid duplication.
Hotels may select an option upon registration (in exchange for a premium) in order to appear first in search.
Guest has auto incremented id which is added in Reservation when booking is done.
Search (startdate price location roomtype customer rating)
Booking (name birthdate phone address)


