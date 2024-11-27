

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

## About this Project.

This project started as a hobby project after being away from webdev for a few years. I wanted to use a robust framework such as Laravel and to use a frontend JS framework such as Vue.js
I've been working on and off in my spare time, studying documentation and see if I could build something that would confirm I still have the chops ;)
What this project is and isn't:

- It can be configured to work with any of [API-football.com's](https://www.api-football.com/) endpoints. All major tournaments, even all local leagues. 
- I haven't had the opportunity to develop this project using TDD, though I'm well aware that is the way to go.
- The betting pool feature would allow users to invite their friends and put a wager on the games and final winner, top goalscorer etc.
- As it stands the app is not dynamic or adaptive yet. It is however very scalable and can handle lots of concurrent users and requests.

## Screenshots

User registration

![register](https://github.com/user-attachments/assets/2f8fd0be-0871-4e41-b5a9-f4c7676b4459)

User login

![login](https://github.com/user-attachments/assets/f4fe92b3-430f-4837-95b7-e37b9782018a)

Player / Team Statistics

![team](https://github.com/user-attachments/assets/05f6d6f9-76ab-4348-bb68-2448b6aae269)

Game Statistics

![game](https://github.com/user-attachments/assets/7ef01670-13bd-4855-b763-bcf924e8614e)

Before Elon Musk took over Twitter they had a very nice accesible api with a realtime timeline you could access. I leveraged it in a way it would should realtime tweets during a match.

https://github.com/user-attachments/assets/0744d1a8-31e0-40b0-8eb4-94203d3e69a9

Followed Games

![followed](https://github.com/user-attachments/assets/e9383879-5068-4ad2-84dc-41cdf538d8da)

Start of bettingpool page

![pool](https://github.com/user-attachments/assets/bd78be23-2968-47c9-babd-6ad8ec786520)

This is to be the main functionality of the app, where you can compare your luck / knowledge of the games and makes wagers. It would have statistics of your bets and compare them to other users / friends.

## Videos of the app's functionality

REGISTER

https://github.com/user-attachments/assets/ad480653-2cef-4806-9ded-e22b1e78d7b8

MAIN

https://github.com/user-attachments/assets/809318b1-0386-4ec6-9f7d-ec2e4bfef8e6

TEAMS

https://github.com/user-attachments/assets/42d157be-4801-4ba8-b6ac-7475f133acef

GAME

https://github.com/user-attachments/assets/94fa6ff2-e733-43d2-8377-93a657be26dc

FOLLOWED GAMES

https://github.com/user-attachments/assets/435b5be0-fad1-4331-8e6b-71de600659ef

NOTIFICATIONS

https://github.com/user-attachments/assets/3fad4204-4e12-4f0c-9e5a-23516dc55faa

### Some remarks on the project and my decisions

- Why did I use Laravel over let's say Symfony?
  I choose Laravel over it's slower learning curve-- I really wanted to just start building right out of the gate and not deal with a steep learning curve. 
  I do realize now later on that Symfony has a more modular approach which could've been more beneficial to my needs.
  Laravel does have the advantage of more community support which I found helpful over the years. Symfony does as well, but it's more geared to enterprise-level solutions and I wanted this to just be a hobby project.

  For smaller apps like these hobby projects Laravel's performance is sufficient enough. As I would grow this app I would swap to Symfony due to it's optimization capabalities.

- Why did I go with Vue.js instead of React?
  Again I chose beginner friendly over a learning curve. Straigh forward syntax, ability to write my own custom CSS which was very important to me-- single file components make all the difference to me.
  With React, relying on third-party libraries like Redux, MobX would slow down development time. Felt like a bit of an overkill.
    


