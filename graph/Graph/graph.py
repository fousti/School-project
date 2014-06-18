# Encoding: UTF-8
"""
Class representing Graph
"""
from heapq import *

class Graph(object):
    def __init__(self, graph_dict={}):
        self.__graph_dict = graph_dict
        self.converter = None

    def print_graph(self):
        print self.__graph_dict

    def set_converter(self, converter):
        self.converter = converter

    def convert(self, path_to_file):
        """
    	Convert with given converter, returning rows with format : ['source', 'target', 'destination']
    	"""
        reader = self.converter.convert(path_to_file)
        for row in reader:
            self.add_vertex(row[0])
            self.add_edge((row[0], row[1], float(row[2])))

    def add_vertex(self, vertex):
        if vertex not in self.__graph_dict:
            self.__graph_dict[vertex] = []

    def add_edge(self, edge):
        (vertex1, vertex2, weight) = tuple(edge)
        if vertex1 in self.__graph_dict:
            self.__graph_dict[vertex1].append((vertex2, weight))
        else:
            self.__graph_dict[vertex1] = [(vertex2, weight)]

    def find_path(self, start, end, path=[]):
        path = path + [start]
        if start == end:
            return path
        if not self.__graph_dict.has_key(start):
            return None
        for node in self.__graph_dict[start]:
            (vertex, weight) = tuple(node)
            if vertex not in path:
                newpath = self.find_path(vertex, end, path)
                if newpath: return newpath
        return None

    def djikstra(self, start, end):
        p = {} # Dict of predecessor
        d = {start: 0} # Dict of final distance
        M = set()
        priority_queue = [(start, 0)]

        while priority_queue != []:
            x, dx = heappop(priority_queue)
            if x in M:
                continue

            M.add(x)

            for vertex, distance in self.__graph_dict[x]:
                if vertex in M:
                    continue
                dy = dx + distance
                if vertex not in d or d[vertex] > dy:
                    d[vertex] = dy
                    heappush(priority_queue, (vertex, dy))
                    p[vertex] = x

        path = [end]
        x = end
        while x != start:
            x = p[x]
            path.insert(0, x)

        return d[end], path

