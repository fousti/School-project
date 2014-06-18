# Encoding: UTF-8
"""
Run Graph program from CLI
Usage : python run.py {start_node} {end_node} {path/to/csv}
"""

from Graph.graph import Graph
from Converter.csv_converter import CsvConverter
import pprint
import argparse

# Get arg from CLI
argparser = argparse.ArgumentParser(description="Run Graph program from CLI")
argparser.add_argument('start_node', help="The start node for pathfinding")
argparser.add_argument('end_node', help="The end node for pathfinding")
argparser.add_argument('csv_file', help="csv file representing graph as : ['source', 'target', 'cost']")
args = argparser.parse_args()

graph = Graph()
graph.set_converter(CsvConverter())
graph.convert(args.csv_file)
print "Graph loaded :"
graph.print_graph()
path = graph.find_path(args.start_node, args.end_node)
pprint.pprint("A path exists from %s to %s" % (args.start_node, args.end_node))
pprint.pprint(path)
shortest_path = graph.djikstra(args.start_node, args.end_node)
print "And the minimum cost path is :"
pprint.pprint(shortest_path)
