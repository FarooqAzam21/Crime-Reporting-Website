const express = require('express');
const passport = require('passport');
const User = require('../models/User');
const router = express.Router();

router.post('/signup', (req, res) => {
    const { username, password } = req.body;
    const newUser = new User({ username, password });

    newUser.save((err) => {
        if (err) return res.status(500).send('Error registering new user');
        res.status(200).send('User registered');
    });
});

router.post('/login', passport.authenticate('local'), (req, res) => {
    res.status(200).send('Logged in');
});

module.exports = router;