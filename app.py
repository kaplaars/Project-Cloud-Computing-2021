import math
import json
from flask import Flask, request
from flask_restful import Resource, Api
from flask_cors import CORS

app = Flask(__name__)
CORS(app)
api = Api(app)

@app.route("/<points1>/<name1>/<points2>/<name2>")
def test(points1, name1, points2, name2):
    tosend = [[0 for i in range(20)] for j in range(20)]
    pointsystem = [25, 18, 15, 12, 10, 8, 6, 4, 2, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0]
    for P1 in range(20):
        for P2 in range(20):
            if P1 != P2:
                newpoints1 = float(points1)+pointsystem[P1]
                newpoints2 = float(points2)+pointsystem[P2]
                if newpoints2 > newpoints1:
                    tosend[P1][P2] = name2
                else:
                    tosend[P1][P2] = name1
            else:
                tosend[P1][P2] = "-1"
    toreturn = {"matrix": tosend}
    return toreturn

if __name__ == "__main__":
    app.run(debug=True)
